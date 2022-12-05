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

@section('title','Category List Page')

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
                                <h2 class="title-1">Category List</h2>

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


                  @if(Session('createSuccess'))   {{--   session pyan call lite dar--}}

                        <div class="col-5 offset-7">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><i class="fas fa-check-circle"></i> {{ session('createSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif


                    @if(Session('deleteSuccess'))   {{--   session pyan call lite dar--}}

                    <div class="col-5 offset-7">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-times-circle"></i> {{ session('deleteSuccess') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif

                    @if(Session('updateSuccess'))   {{--   session pyan call lite dar--}}

                    <div class="col-5 offset-7">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-wrench"></i> {{ session('updateSuccess') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif

                   <div class="row">
                       <div class="col-3">
                           <h4 class="text-secondary">Search Key : <span class="text-danger">{{ request('key') }} </span></h4>
                       </div>
                       <div class="col-4 offset-5">
                           <form action="{{ route('category#list') }}" method="get">
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
                          <h3> <i class="fas fa-database text-warning"></i> = {{ $categories->total() }} </h3>
                       </div>
                    </div>


                @if (count($categories) != 0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Created_Date</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($categories as $category)
                                <tr class="tr-shadow">
                                    <td>{{ $category->id }}</td>
                                    <td class="col-6">{{ $category->name }}</td>
                                    <td>{{ $category->created_at->format('j-F-Y') }}</td>
                                    <td>
                                        <div class="table-data-feature">
{{--                                            <button class="item" data-toggle="tooltip" data-placement="top" title="View">--}}
{{--                                                <i class="fas fa-eye"></i>--}}
{{--                                            </button>--}}
                                          <a href="{{ route('category#edit',$category->id) }}" class="mr-1">
                                              <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                  <i class="fas fa-edit text-primary"></i>
                                              </button>
                                          </a>
                                           <a href="{{ route('category#delete',$category->id) }}" class="ml-1">
                                               <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                                   <i class="zmdi zmdi-delete text-danger"></i>
                                               </button>
                                           </a>
                                            {{--                                            <button class="item" data-toggle="tooltip" data-placement="top" title="More">--}}
                                            {{--                                                <i class="zmdi zmdi-more"></i>--}}
                                            {{--                                            </button>--}}
                                        </div>
                                    </td>
                                </tr>
                                <tr class="spacer"></tr>
                            @endforeach


                            </tbody>
                        </table>


                        <div class="mt-3">
                            {{ $categories->links() }}   {{--   Provider htal ka Appserviceprovider mar declearation pyan loke pay ya dal--}}
                            {{--   {{ $categories->appends(request()->query())->links() }}--}}
                        </div>

                    </div>
                @else
                        <div class="text-center mt-5">
                            <img class="" src="{{ asset('admin/images/icon/nodata.png') }}">
                            <h3 class="text-secondary mt-2">There is no Category Here!</h3>
                        </div>

                    @endif
                    <!-- END DATA TABLE -->


                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
