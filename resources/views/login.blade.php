@extends('layouts.master')

@section('title',"Login Page")
@section('content')

    <div class="login-form">
        <form action="{{route('login')}}" method="post">
            @csrf

            @if(Session('changeSuccess'))   {{--   session pyan call lite dar--}}

            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-check-circle"></i> {{ session('changeSuccess') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
            </div>
              @error('email')
              <small class="text-danger">{{$message}}</small>
             @enderror
            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
            </div>
            @error('password')
            <small class="text-danger">{{$message}}</small>
            @enderror

            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>

        </form>
        <div class="register-link">
            <p>
                Don't you have account?
                <a href="{{route('auth#registerPage')}}">Sign Up Here</a>
            </p>
        </div>
    </div>
    </div>



@endsection
