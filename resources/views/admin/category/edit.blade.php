@extends('admin.layouts.master')

@section('title','Category List Page')

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
                                <h3 class="text-center title-2">Edit Your Category</h3>
                            </div>
                            <hr>
                            <form action="{{ route('category#update') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Name</label>
                                    <input type="hidden" name="categoryId" value="{{ $category->id }}">
                                    <input id="cc-pament" name="categoryName" type="text" value="{{ old('categoryName',$category->name,) }}" class="form-control @error('categoryName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Seafood...">
                                    @error('categoryName')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block zz">
                                        <span id="payment-button-amount">Update </span> <i class="fas fa-chevron-circle-right"></i>
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
