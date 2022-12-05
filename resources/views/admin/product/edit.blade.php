
@extends('admin.layouts.master')

@section('title','Edit Pizza Details')

@section('content')


    <!-- MAIN CONTENT-->
    <div class="main-content">
        @if(Session('update'))   {{--   session pyan call lite dar--}}

        <div class="col-5 offset-7">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-check-circle"></i> {{ session('update') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif

        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-5 ">
                          <a href="{{ route('product#list') }}">
                                <i class="fas fa-backward text-dark" ></i>
                          </a>
                            </div>


                            <hr>

                            <div class="row">
                                <div class="col-5 offset-1">
                                            <img src='{{ asset('storage/'.$pizza->image) }}' class="shadow-md"/>

                                </div>

                                <div class="col-6">

                                    <span class="btn bg-info text-white my-3 d-block"><i class="fas fa-utensils me-2"></i> {{ $pizza->name }}</span>
                                    <span class="my-3 btn bg-dark text-white mr-1"><i class="fas fa-money-bill-wave "></i> {{ $pizza->price }} kyats</span>
                                    <span class="my-3 btn bg-dark text-white mr-1"><i class="fas fa-hourglass-end "></i> {{ $pizza->waiting_time }} mins</span>
                                    <span class="my-3 btn bg-dark text-white mr-1"><i class="fas fa-eye"></i> {{ $pizza->view_count }}</span>
                                    <span class="my-3 btn bg-dark text-white"> <i class="fas fa-link"></i> {{ $pizza->category_name   }}</span>
                                    <span class="my-3 btn bg-dark text-white"><i class="far fa-clock"></i> {{ $pizza->created_at->format('j-F-Y') }}</span>
                                    <div class="my-3 text-secondary"><i class="far fa-comment-alt text-warning"></i> Details </div>
                                    <div class="">{{ $pizza->description }}</div>

                                </div>

                            </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->

@endsection



