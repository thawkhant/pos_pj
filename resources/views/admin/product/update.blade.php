

@extends('admin.layouts.master')

@section('title','Pizza Update Page')

@section('content')


    <!-- MAIN CONTENT-->
    <div class="main-content">
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

                            <div class="row">
                                <div class="card-title col-6 offset-5">
                                    <h2 class=" title-1 text-secondary">Update Pizza</h2>
                                </div>
                            </div>

                            <hr>

                            <form action="{{ route('product#update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div  class=" col-4 offset-1 mt-4">
                                        <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">
                                            <img src='{{ asset("storage/".$pizza->image) }}' width="250px"/>



                                        <div class="form-group mt-3">
                                            <input type="file" name="pizzaImage" class="form-control @error('pizzaImage') is-invalid @enderror" id="">
                                            @error('pizzaImage')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group d-grid">
                                            <button class="btn bg-primary  text-white" type="submit">
                                                Update <i class="fas fa-chevron-circle-right"></i>
                                            </button>
                                        </div>
                                    </div>



                                    <div class=" col-7 ">

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="pizzaName" type="text"  class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Edit Pizza Name.." value="{{ old('name',$pizza->name)}}">
                                            @error('pizzaName')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Description</label>
                                            <textarea name="pizzaDescription" id="" cols="20" rows="5" class="form-control @error('pizzaDescription') is-invalid @enderror" placeholder="Edit Pizza Description" >{{ old('description',$pizza->description) }}</textarea>
                                            @error('pizzaDescription')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="pizzaPrice" type="number"  class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Edit Pizza Price..." value="{{ old('price',$pizza->price) }}">
                                            @error('pizzaPrice')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Category</label>
                                            <select name=" pizzaCategory" class="form-control @error('pizzaCategory') is-invalid @enderror">
                                                <option value="">Choose Pizza Category...</option>
                                                @foreach($category as $c)
                                                  <option value="{{ $c->id }}" @if($pizza->category_id == $c->id)selected @endif>{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('pizzaCategory')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                            <input id="cc-pament" name="pizzaWaitingTime" type="number"  class="form-control @error('pizzaWaitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Edit Waiting Time..." value="{{ old('waitingTime',$pizza->waiting_time) }}">
                                            @error('pizzaWaitingTime')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">ViewCount</label>
                                            <input id="cc-pament" name="viewCount" type="number" disabled  class="form-control" aria-required="true" aria-invalid="false" placeholder="Edit View Count..." value="{{ old('viewCount',$pizza->view_count) }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Created Date</label>
                                            <input id="cc-pament" name="createdDate" type="text" disabled  class="form-control" aria-required="true" aria-invalid="false"  value="{{ $pizza->created_at->format('j-F-Y') }}">
                                        </div>






                                    </div>
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



