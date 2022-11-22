<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use App\Models\Category;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // direct Category List Page

    public  function  list(): Factory|View|Application
    {
        $categories = Category::when(request('key'),function($query){     // data searching
         $query->where("name",'like','%'. request('key') .'%');
        })->orderBy('id','desc')->paginate(4);
        $categories->appends(request()->all());
       // dd($categories->toArray());
        return view('admin.category.list',compact('categories'));  // compact ka a paw ka har ko yu dar
    }

    // direct Category Create Page
    public  function createPage(): Factory|View|Application
    {
        return view('admin.category.create');
    }

    // create Category
    public function create(Request $request){
    // dd($request->all());
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);   // db htal mar win store dar
        return redirect()->route('category#list')->with(['createSuccess'=>"အမျိုးအစားကို ဖန်တီးခဲ့သည်..."]);  // with ka session section pr sir
    }

    //  delete category
    public function delete($id){
        //    dd($id);
        Category::where('id',$id)->delete();
        return back()->with([ 'deleteSuccess' => "အမျိုးအစားကို ဖျက်လိုက်ပါပြီ..."]);
    }

    //  edit page
    public function edit($id){
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    // update Page
     public function update(Request $request){
         //  dd($request->all());
         $this->categoryValidationCheck($request);
         $data = $this->requestCategoryData($request);
         Category::where('id',$request->categoryId)->update($data);
         return redirect()->route('category#list')->with(['updateSuccess'=>"အမျိုးအစားကို အောင်မြင်စွာ မွမ်းမံပြီးပါပြီ ..."]);
     }

    // categoryValidationCheck
    private function categoryValidationCheck($request){
     Validator::make($request->all(),[
         'categoryName' => 'required|unique:categories,name,'.$request->categoryId   // tablename,columnname     // thu ko tu ya dal
     ],[
         'categoryName.required' => "သင့်ထုတ်ကုန်အမျိုးအစားအမည်ကို ဖြည့်စွက်ပါ",
         'categoryName.unique' => "ကုန်ပစ္စည်းအမျိုးအစားအမည် မတူရပါ",
     ])->validate();
    }

    // request category data
    private function requestCategoryData($request){
        return [
          'name' => $request->categoryName      // column name -> userinput name
        ];
    }
}
