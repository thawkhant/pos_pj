<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //  direct login page
    public function loginPage(){
      return view('login');
    }

    // direct register page
    public function registerPage(){
        return view('register');
    }

    // direct dashboard
    public function dashboard(){
        if(Auth::user()->role == 'admin'){
            return redirect()->route('category#list');
        }
        return redirect()->route('user#home');    // route net ma ya buu
    }

    // Change password page
    public function changePasswordPage(){
        return view('admin.category.create');
    }



}
