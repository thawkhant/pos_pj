

@extends('admin.layouts.master')

@section('title','Change Password')

@section('content')


    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title text-center">
                                <span class="text-center title-2">Account Info </span>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-3 offset-2">
                                        @if(Auth::user()->image == null)
                                            <a href="#">
                                                <img src='{{ asset("image/defaultUser.png") }}' class="shadow-md" />
                                            </a>
                                        @else
                                            <a href="#">
                                                <img src=''/>
                                            </a>
                                        @endif
                                </div>

                                <div class="col-5 offset-1">

                                    <h4 class="my-3 text-secondary"><i class="fas fa-user-circle text-primary mr-5"></i> {{ Auth::user()->name }}</h4>
                                    <h4 class="my-3 text-secondary"><i class="fas fa-envelope text-warning mr-5"></i> {{ Auth::user()->email }}</h4>
                                    <h4 class="my-3 text-secondary"><i class="fas fa-phone text-success mr-5"></i> {{ Auth::user()->phone }}</h4>
                                    <h4 class="my-3 text-secondary"><i class="fas fa-map-marker-alt text-info mr-5"></i> {{ Auth::user()->address }}</h4>
                                    <h4 class="my-3 text-secondary"><i class="fas fa-calendar-check text-primary mr-5"></i> {{ Auth::user()->created_at->format('j-F-Y') }}</h4>
                                </div>

                            </div>

                            <div class="row">
                            <div class="col-4 offset-8 mt-3">
                              <a href="{{ route('admin#edit') }}">
                                  <button class="btn btn-dark">
                                      <i class="fas fa-edit me-2 text-primary"></i> Edit Profile
                                  </button>

                              </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection



