<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;


// login , register
Route::middleware(['admin_auth'])->group(function (){
    Route::redirect('/','loginPage');

    Route::get('loginPage',[AuthController::class,'loginPage'])->name("auth#loginPage");
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});

Route::middleware(['auth'])->group(function () {

    // dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    // admin
    // Route::group(['middleware'=>'admin_auth'],function(){
    //  de htal mar win yae paw
    //  });

        Route::middleware(['admin_auth'])->group(function(){
            // Category
            Route::prefix('category')->group(function(){
                Route::get('list',[CategoryController::class,'list'])->name('category#list');
                Route::get("create/page",[CategoryController::class,'createPage'])->name('category#createPage');
                Route::post('create',[CategoryController::class,'create'])->name('category#create');
                Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
                Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
                Route::post('update',[CategoryController::class,'update'])->name('category#update');

           });

            // admin account
            Route::prefix('adm')->group(function(){
            // password
            Route::get('password/changePage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('change/password',[AdminController::class,'changePassword'])->name('admin#changePassword');

            // profile
            Route::get('details',[AdminController::class,'details'])->name('admin#details');
            Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
            Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');

                // admin list
            Route::get('list',[AdminController::class,'list'])->name('admin#list');
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            Route::get('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
            Route::post('change/role/{id}',[AdminController::class,'change'])->name('admin#change');

  });

            // products
            Route::prefix('product')->group(function (){
               Route::get('list',[ProductController::class,'list'])->name('product#list');
               Route::get('createPage',[ProductController::class,'createPage'])->name('product#createPage');
               Route::post('createPage',[ProductController::class,'create'])->name('product#create');
               Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
               Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
               Route::get('updatePage/{id}',[ProductController::class,'updatePage'])->name('product#updatePage');
               Route::post('update',[ProductController::class,'update'])->name('product#update');
            });


                });

// user
// home
    Route::group(['prefix'=>'user','middleware'=>'user_auth'],function (){
//        Route::get("home",function (){
//            return view('user.home');
//        })->name('user#home');


        Route::get('/homePage',[UserController::class,'home'])->name('user#home');


    });
});
