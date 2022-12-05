<?php

namespace App\Http\Controllers;

use App\Models\Category;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // product list
    public function list(){
       $pizzas = Product::select('products.*','categories.name as category_name')->when(request('key'),function($query){    // data searching pr sir
           $query->where('products.name','like','%'.\request('key').'%');
       })
           ->leftJoin('categories','products.category_id','categories.id')
       ->orderBy('products.created_at','desc')->paginate(3);  // to avoid overwrite we take products sir
        //  dd($pizzas->toArray());
         $pizzas->appends(request()->all());
        return view('admin.product.pizzaList',compact('pizzas'));
    }

    // direct pizza Create Page
    public function createPage(){
        $categories = Category::select('id','name')->get();     // category twe ko lar yu dar
        // dd($categories->toArray());
        return view('admin.product.create',compact('categories'));
    }

    //  delete pizza
    public function delete($id){
        Product::where("id",$id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess' => "ပီဇာကို အောင်မြင်စွာ ဖျက်လိုက်ပါပြီ"]);
    }

    //  edit pizza
    public function edit($id){
      $pizza =  Product::select('products.*','categories.name as category_name')
          ->leftJoin('categories','products.category_id','categories.id')
          ->where("products.id",$id)->first();
        return view('admin.product.edit',compact('pizza'));
    }

    //  Pizza update pizza
    public function updatePage($id){
        $pizza = Product::where('id',$id)->first();
        $category = Category::get();
        return view('admin.product.update',compact('pizza','category'));
    }

    //  Pizza update
    public function update(Request $request){
        $this->productValidationCheck($request,'update');
        // dd('success');
        $data = $this->requestProductInfo($request);
        // dd($data);

        if($request->hasFile('pizzaImage')){
            $oldImageName = Product::where('id',$request->pizzaId)->first();
            $oldImageName = $oldImageName->image;
            // dd($oldImageName);

            if($oldImageName != null){      // shi yin delete loke mar
                Storage::delete('public/'.$oldImageName);
            }

            $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('product#list');
    }

    // direct create product
    public function create(Request $request){
        //  dd($request->all());
        $this->productValidationCheck($request,'create');
        $data = $this->requestProductInfo($request);

        if($request->hasFile('pizzaImage')){
            $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$fileName);
            $data['image'] =$fileName;
        }

        Product::create($data);
        return redirect()->route('product#list')->with(['createSuccess' => "ပီဇာအသစ်တစ်ခုကို အောင်မြင်စွာ ဖန်တီးလိုက်ပါပြီ"]);
    }

    //  request  product info
    private function requestProductInfo($request){
        return [
            'category_id' => $request->pizzaCategory,
            'name' => $request->pizzaName,
            'description' => $request->pizzaDescription,
            'price' => $request->pizzaPrice,
            'waiting_time' => $request->pizzaWaitingTime,
            ];
    }

    // product validation check
    private function productValidationCheck($request,$action){
        $validationRules = [
            'pizzaName' => 'required|min:5|unique:products,name,'.$request->pizzaId,      // thu ko thu so unique ya dal
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required|min:10',

            'pizzaPrice' => 'required',
            'pizzaWaitingTime' => 'required',
        ];

        $validationRules['pizzaImage'] = $action == "create" ?  'required|mimes:jpg,jpeg,png|file' : "mimes:jpg,jpeg,png|file";
        // dd($validationRules);
        Validator::make($request->all(),$validationRules

        ,[
            'pizzaName.required' => 'ပီဇာအမည် လိုအပ်သည်...',
            'pizzaName.min' => 'ပီဇာအမည်သည် စာလုံးငါးလုံးထက်ကြီးရပါမည်...',
            'pizzaName.unique' => "ပီဇာအမည် မတူရပါ...",
            'pizzaCategory.required' => 'ပီဇာအမျိုးအစား ဖြည့်စွက်ရပါမည်...',
            'pizzaDescription.required' => 'ဖော်ပြချက်ကို ဖြည့်စွက်ရန် လိုအပ်ပါသည်...',
            'pizzaDescription.min' => "ဖော်ပြချက်သည် စကားလုံးဆယ်လုံးထက် ကြီးရမည်...",
            'pizzaImage.required' => 'ပီဇာပုံကို ဖြည့်စွက်ရပါမည်...',
            'pizzaImage.mimes' => 'ပုံအမျိုးအစားသည် JPG | PNG | JPEG ဖြစ်ရမည်...',
            'pizzaPrice.required' => 'ပီဇာဈေးဖြည့်ရပါမည်...',
            'pizzaWaitingTime.required' => 'ပီဇာ စောင့်ဆိုင်းချိန် ဖြည့်စွက်ရပါမည်'
        ])->validate();
    }
}
