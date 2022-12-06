<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    // Change password page
    public function changePasswordPage(){
        return view('admin.password.change');

    }

    // change password

    public function changePassword(Request $request){
        //  dd($request->all());
        //  *****************
        //  1. all field must be fill
        //  2. new password & confirm password length must be greater than 6
        //  3. new password and confirm password must be same
        //  4. client old password must be same with db password
        //  5. password change

        $this->passwordValidationCheck($request);
        //   $currentUserId = Auth::user()->id;
        //  $user = User::select('password')->where('id',$currentUserId)->first();
        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbHashValue = $user->password; //hash value
        if(Hash::check($request->oldPassword,$dbHashValue)){
            //dd('password Same');
            $data = [
                'password' => Hash::make($request->newPassword)
            ]; // pw change lite dar
            User::where('id',Auth::user()->id)->update($data);

            Auth::logout();
            return redirect()->route('auth#loginPage')->with(['changeSuccess' => 'စကားဝှက်ကို အောင်မြင်စွာ ပြောင်းလဲပြီးပါပြီ...']);
        }//else{
        // dd('password Incorrect');
        return back()->with(['notMatch' => 'စကားဝှက်ဟောင်းနှင့် မကိုက်ညီပါ ထပ်ကြိုးစားပါ။']);
        // }
        //  dd($dbPassword);
        // dd(Hash::make('thawkhant'));  // to hash data
        // dd($user->toArray());


    }

    //  direct admin details page
    public function details(){
        return view('admin.account.detail');
    }

    // direct admin profile page
    public function edit(){
        return view('admin.account.edit');
    }

    // update account
    public function update($id,Request $request){
        // dd($id,$request->all());
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);
        // fro image
        if($request->hasFile('image')){
            // 1 old image name | check => shi yin delete | ma shi yin store
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;
            // dd($dbImage);

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

           $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            // dd($fileName);
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        User::where('id',$id)->update($data);
        return redirect()->route('admin#details')->with(['update'=>'စီမံခန့်ခွဲသူအကောင့်ကို အောင်မြင်စွာ မွမ်းမံပြီးပါပြီ...']);
    }

    //  admin list
    public function list(){
        $admin = User::when(request('key'),function($query){
           $query->orWhere('name','like','%'.request('key').'%')
               ->orWhere('email','like','%'.request('key').'%')
               ->orWhere('gender','like','%'.request('key').'%')
               ->orWhere('phone','like','%'.request('key').'%')
               ->orWhere('address','like','%'.request('key').'%');
        })
            ->where('role','admin')->paginate(3);
        $admin->appends(request()->all());
        //  dd($admin->toArray());
     return view('admin.account.list',compact('admin'));
    }

    // delete admin account
    public function delete($id){
        //  dd("delete");
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => 'စီမံခန့်ခွဲသူအကောင့်ကို ဖျက်လိုက်ပါပြီ...']);
    }

    // change Role
    public function changeRole($id){
        $account = User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
    }

   // change
    public function change($id,Request $request){
        $data = $this->requestUserData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }

   // requestUserData
     private function requestUserData($request){
        return [
            'role' => $request->role
        ];
     }

    // request user data
    private function getUserData($request){
        return [
          'name' => $request->name,
          'email' => $request->email,
          'gender' => $request->gender,
          'phone' => $request->phone,
          'address' => $request->address,
            'updated_at' => Carbon::now()
        ];
    }

    // account validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'image' => 'mimes:png,jpg,jpeg|file'
        ],[
            'name.required' => "အမည်ဖြည့်ရန် လိုအပ်ပါသည်",
            'email.required' => 'email ဖြည့်ရန် လိုအပ်ပါသည်',
            'gender.required' => 'ကျား | မ ဖြည့်စွက်ရန် လိုအပ်ပါသည်',
            'phone.required' => 'ဖုန်းနံပါတ်ဖြည့်ပေးရပါမယ်',
            'address.required' => 'လိပ်စာဖြည့်စွက်ရန် လိုအပ်ပါသည်',
            'image.mimes' => 'ဖိုင်အမျိုးအစားသည် PNG | JPG | JPEG ဖြစ်ရမည်'
        ])->validate();
    }


    // password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword',
        ],[
            'oldPassword.required' => 'စကားဝှက်ဟောင်း လိုအပ်ပါသည်',
            'newPassword.required' => 'စကားဝှက်အသစ်လိုအပ်သည်',
            'confirmPassword.required' => 'အတည်ပြုစကားဝှက် လိုအပ်သည်',
            'oldPassword.min' => 'စကားဝှက်သည် စာလုံးခြောက်လုံးထက်ကြီးရမည်',
            'newPassword.min' => 'စကားဝှက်သည် စာလုံးခြောက်လုံးထက်ကြီးရမည်',
            'confirmPassword.min' => 'စကားဝှက်သည် စာလုံးခြောက်လုံးထက်ကြီးရမည်',
            'confirmPassword.same' => 'စကားဝှက်အသစ်နှင့် အတည်ပြုစကားဝှက်သည် တူညီရပါမည်',
        ])->validate();
    }
}
