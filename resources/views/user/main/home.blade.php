{{--<html >--}}
{{--<head>--}}
{{--    <title>User Home Page</title>--}}
{{--</head>--}}
{{--<body>--}}
{{--       <h1>User Home Page</h1>--}}

{{--       Role - {{ Auth::user()->role }}--}}

{{--        <form action="{{ route('logout') }}" method="post">--}}
{{--         @csrf--}}
{{--            <input type="submit" value="Logout">--}}
{{--        </form>--}}
{{--</body>--}}
{{--</html>--}}

@extends('user.layouts.master')

@section('content')

    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Categories</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class=" d-flex align-items-center justify-content-between mb-3 bg-dark text-white px-3 py-1">
                            <label class="mt-2" for="price-all">Categories</label>
                            <span class="badge border font-weight-normal">{{ count($category) }}</span>
                        </div>

                        @foreach($category as $c)
                            <div class=" d-flex align-items-center justify-content-between mb-3 shadow-sm pt-1">
                                <label class="" for="price-1">{{ $c->name }}</label>
{{--                                <span class="badge border font-weight-normal">150</span>--}}
                            </div>

                        @endforeach

                    </form>
                </div>
                <!-- Price End -->


            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Latest</a>
                                        <a class="dropdown-item" href="#">Popularity</a>
                                        <a class="dropdown-item" href="#">Best Rating</a>
                                    </div>
                                </div>
                                <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">10</a>
                                        <a class="dropdown-item" href="#">20</a>
                                        <a class="dropdown-item" href="#">30</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                      @foreach($pizza as $p)
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100 " src="{{ asset( 'storage/' .$p->image) }}" alt="" style="height: 40vh">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fas fa-info-circle"></i></a>

                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>{{ $p->price }} Kyats</h5>
{{--                                        <h5>20000 kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6>--}}
                                    </div>
{{--                                    <div class="d-flex align-items-center justify-content-center mb-1">--}}
{{--                                        <small class="fa fa-star text-primary mr-1"></small>--}}
{{--                                        <small class="fa fa-star text-primary mr-1"></small>--}}
{{--                                        <small class="fa fa-star text-primary mr-1"></small>--}}
{{--                                        <small class="fa fa-star text-primary mr-1"></small>--}}
{{--                                        <small class="fa fa-star text-primary mr-1"></small>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

@endsection
