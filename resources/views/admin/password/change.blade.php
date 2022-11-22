

@extends('admin.layouts.master')

@section('title','Change Password')

@section('content')


    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4 offset-7">
                        <a href={{ route('category#list') }}><button class="btn bg-dark text-white my-3"> <i class="fas fa-clipboard-list"></i>  Categories List </button></a>
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Password</h3>
                            </div>
                            <hr>
                            <form action="{{ route('category#create') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                    <input id="cc-pament" name="categoryName" type="text" value="{{ old('categoryName') }}" class="form-control @error('categoryName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Old Password...">
                                    @error('categoryName')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">New Password</label>
                                    <input id="cc-pament" name="categoryName" type="text" value="{{ old('categoryName') }}" class="form-control @error('categoryName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter New Password...">
                                    @error('categoryName')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                    <input id="cc-pament" name="categoryName" type="text" value="{{ old('categoryName') }}" class="form-control @error('categoryName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Confirm Password...">
                                    @error('categoryName')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block zz">
                                        <span id="payment-button-amount">Change Password </span> <i class="fas fa-key"></i></i>
                                        {{--                                        <span id="payment-button-sending" style="display:none;">Sending…</span>--}}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
