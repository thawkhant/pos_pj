{{--<html>--}}
{{--<head>--}}
{{--   <title>List</title>--}}
{{--</head>--}}
{{--<body>--}}
{{--     Hello I am Admin Category Page--}}
{{--     Role - {{ Auth::user()->role}}--}}

{{--<form action="{{ route('logout') }}" method="post">--}}
{{-- @csrf--}}
{{--    <input type="submit" value="Log Out">--}}
{{--</form>--}}
{{--</body>--}}
{{--</html>--}}

@extends('admin.layouts.master')

@section('title','Admin List Page')

@section('content')


    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Admin List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href={{ route('category#createPage') }}>
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add Category
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="fas fa-download"></i> CSV download
                            </button>
                        </div>
                    </div>




                    @if(Session('deleteSuccess'))   {{--   session pyan call lite dar--}}

                    <div class="col-5 offset-7">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-times-circle"></i> {{ session('deleteSuccess') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif


                    <div class="row">
                        <div class="col-3">
                            <h4 class="text-secondary">Search Key : <span class="text-danger">{{ request('key') }} </span></h4>
                        </div>
                        <div class="col-4 offset-5">
                            <form action="{{ route('admin#list') }}" method="get">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" placeholder="Search..." value="{{ request('key') }}">
                                    <button class="btn btn bg-dark text-white" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-1 offset-10 bg-white shadow-md py-2 px-2 my-1 text-center">
                            <h3> <i class="fas fa-database text-warning"></i> {{ $admin->total() }}  </h3>
                        </div>
                    </div>


                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Admin Name</th>
                                    <th>Admin Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($admin as $a)
                                    <tr class="tr-shadow">
                                        <td class="col-2">
                                            @if( $a->image == null)
                                               @if($a->gender == 'male')
                                                    <img  src="{{ asset('image/defaultUser.png') }}">
                                                @else
                                                    <img  src="{{ asset('image/female.jpg') }}">
                                                @endif
                                            @else
                                                <img  src="{{ asset('storage/'.$a->image) }}">
                                            @endif
                                        </td>
                                     <td>{{ $a->name }} </td>    {{--  ({{ Auth::user()->id }})  this step is important --}}
                                        <td>{{ $a->email }}</td>
                                        <td>{{ $a->gender }}</td>
                                        <td>{{ $a->phone }}</td>
                                        <td>{{ $a->address }}</td>
                                        <td>
                                            <div class="table-data-feature">
{{--                                            <a href="@if(Auth::user()->id == $a->id) # @else {{ route('admin#delete') }} @endif"--}}
{{--                                                 class="ml-1">--}}
{{--                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">--}}
{{--                                                    <i class="zmdi zmdi-delete text-danger"></i>--}}
{{--                                                </button>--}}
{{--                                            </a>--}}

                                                @if(Auth::user()->id == $a->id)

                                                @else
                                                    <a href="{{ route('admin#delete',$a->id) }}">
                                                        <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Change Role">
                                                            <i class="fas fa-level-down-alt text-warning"></i>
                                                        </button>
                                                    </a>

                                                  <a href="{{ route('admin#delete',$a->id) }}">
                                                      <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                                          <i class="zmdi zmdi-delete text-danger"></i>
                                                      </button>
                                                  </a>
                                                @endif
                                            </div>
                                        </td>

                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach


                                </tbody>
                            </table>


                            <div class="mt-3">
                              {{ $admin->links() }}  {{--   Provider htal ka Appserviceprovider mar declearation pyan loke pay ya dal--}}
                            </div>

                        </div>

                <!-- END DATA TABLE -->


                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
