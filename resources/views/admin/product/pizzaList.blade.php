

@extends('admin.layouts.master')

@section('title','Product List Page')

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
                                <h2 class="title-1">Product List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right"  >
                            <a href={{ route('product#createPage') }}>
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add Pizza
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="fas fa-download"></i> CSV download
                            </button>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-3">
                            <h4 class="text-secondary">Search Key : <span class="text-danger">{{ request('key') }} </span></h4>
                        </div>
                        <div class="col-4 offset-5" >
                            <form action="{{ route('product#list') }}" method="get" >
                                @csrf
                                <div class="d-flex" >
                                    <input type="text" name="key" class="form-control" placeholder="Search..." value="{{ request('key') }}">
                                    <button class="btn btn bg-dark text-white" type="submit">
                                        <i class="fas fa-search" ></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if(Session('createSuccess'))   {{--   session pyan call lite dar--}}

                    <div class="col-5 offset-7 mt-2">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-check-circle"></i> {{ session('createSuccess') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif

                    @if(Session('deleteSuccess'))   {{--   session pyan call lite dar--}}

                    <div class="col-5 offset-7 mt-2">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-exclamation-triangle"></i> {{ session('deleteSuccess') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif


                    <div class="row mt-2">
                        <div class="col-1 offset-10 bg-white shadow-md py-2 px-2 my-1 text-center">
                            <h3> <i class="fas fa-database text-warning"></i> {{ $pizzas->total() }}</h3>
                        </div>
                    </div>



                    @if (count($pizzas) != 0)

                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>


                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>View Count</th>
                                    </tr>
                                </thead>
                                <tbody>


                                @foreach($pizzas as $p)
                                    <tr class="tr-shadow">
                                        <td class="col-2"><img src="{{ asset('storage/'. $p->image ) }}"> </td>
                                        <td class="col-3">{{ $p->name }}</td>
                                        <td class="col-2">{{ $p->price }}</td>
                                        <td class="col-2">{{ $p->category_name }}</td>
                                        <td class="col-2"> <i class="fas fa-eye"></i> {{ $p->view_count }}</td>
                                        <td>
                                            <div class="table-data-feature">

                                                <a href="{{ route('product#edit',$p->id) }}" class="mr-1">
                                                    <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Detail">
                                                        <i class="fas fa-info-circle text-info"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('product#updatePage', $p->id) }}" class="mr-1">
                                                    <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fas fa-edit text-primary"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('product#delete',$p->id) }}" class="ml-1">
                                                    <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete text-danger"></i>
                                                    </button>
                                                </a>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach



                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{ $pizzas->links() }}
                            </div>


                        </div>

                    @else
                        <div class="text-center mt-5">
                            <img class="" src="{{ asset('admin/images/icon/nodata.png') }}">
                            <h3 class="text-secondary mt-2">There is no Pizza Here!</h3>
                        </div>

                @endif



                <!-- END DATA TABLE -->


                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
