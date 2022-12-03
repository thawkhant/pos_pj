<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        //  dd(route('auth#loginPage'));  // this way can check of your route path
        //  dd(url()->current());    //  lint shi yout nay dae route path

        if (!empty(Auth::user())) {      // log in win ma win check dar    true | false
            if (url()->current() == route('auth#loginPage') || url()->current() == route('auth#registerPage')){
                return back();
            }

            if (Auth::user()->role == 'user') {
                abort(404);
            }
            return $next($request);
        }
        return $next($request);
    }

}


