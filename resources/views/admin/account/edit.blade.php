

@extends('admin.layouts.master')

@section('title','Edit Admin Profile')

@section('content')


    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                           <div class="row">
                               <div class="card-title col-6 offset-5">
                                   <h2 class=" title-1 text-secondary">Admin Account Profile</h2>
                               </div>
                           </div>

                            <hr>

                            <form action="{{ route('admin#update',Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div  class=" col-4 offset-1">
                                        @if(Auth::user()->image == null)
                                            @if(Auth::user()->gender == 'male')
                                                <img  src="{{ asset('image/defaultUser.png') }}" width="250px">
                                            @else
                                                <img  src="{{ asset('image/female.jpg') }}" width="250px">
                                            @endif
                                        @else
                                            <img src={{ asset("storage/".Auth::user()->image) }} width="190px"/>
                                        @endif


                                           <div class="float-end mb-3 ml-3">
                                               <button type="button" name="role" class="btn btn-sm bg-success rounded-circle text-white" >{{ old('role',Auth::user()->role) }}</button>
                                           </div>

                                            <div class="form-group mt-3">
                                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="">
                                                @error('image')
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



                                    <div class=" col-7  mt-4">

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text"  class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Name..." value="{{ old('name',Auth::user()->name)}}">
                                           @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="email"  class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Email..." value="{{ old('email',Auth::user()->email) }}">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="text"  class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone..." value="{{ old('phone',Auth::user()->phone) }}">
                                            @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Gender</label>
                                             <select name="gender" class="form-control @error('phone') is-invalid @enderror">
                                                 <option value="">Choose your gender</option>
                                                 <option value="male" @if(Auth::user()->gender == 'male') selected @endif>Male</option>
                                                 <option value="female" @if(Auth::user()->gender == 'female') selected @endif>Female</option>
                                             </select>
                                            @error('gender')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Address</label>
                                            <textarea name="address" id="" cols="20" rows="5" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter Admin Address" >{{ old('address',Auth::user()->address) }}</textarea>
                                            @error('address1')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
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



