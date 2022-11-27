<?php

namespace App\Http\Controllers;

use App\Models\User;
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
