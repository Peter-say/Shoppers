@extends('web.layouts.app')

<style>
    /* .img-fluid {
        height: 30vh;
    } */

    /* Custom Pagination Style */
    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
    }

    .pagination li {
        margin: 0 5px;
    }

    .pagination a,
    .pagination span {
        padding: 6px 12px;
        border: 1px solid #ddd;
        text-decoration: none;
        color: #333;
        border-radius: 4px;
    }

    .pagination .active a,
    .pagination .active span {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }

    .block-4-image {
        position: relative;
        width: 100%;
        padding-top: 100%;
        overflow: hidden;
    }

    .block-4-image img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 80%;
        object-fit: cover;
    }
</style>
@section('contents')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="/">Home</a> <span class="mx-2 mb-0">/</span> <strong
                        class="text-black">Shop</strong></div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">

            <div class="row mb-5">
                <div class="col-md-9 order-2">

                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="float-md-left mb-4">
                                <h2 class="text-black h5">Shop All</h2>
                            </div>
                            <div class="d-flex">
                                <div class="dropdown mr-1 ml-md-auto">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle"
                                        id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Latest
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                                        @foreach ($categories as $category)
                                            <a class="dropdown-item category-link"
                                                href="{{ route('web.shop.category.sucategory', urlencode($category->name)) }}">{{ $category->name }}</a>
                                        @endforeach
                                    </div>
                                    <div id="product-container">
                                        <!-- The filtered products will be displayed here -->
                                    </div>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle"
                                        id="dropdownMenuReference" data-toggle="dropdown">Reference</button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                        <a class="dropdown-item" href="#">Relevance</a>
                                        <a class="dropdown-item" href="#">Name, A to Z</a>
                                        <a class="dropdown-item" href="#">Name, Z to A</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Price, low to high</a>
                                        <a class="dropdown-item" href="#">Price, high to low</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">

                        @foreach ($products as $product)
                            <div class="col-sm-6 col-lg-4 mb-4 product-cover" data-aos="fade-up">
                                <div class="block-4 text-center border">
                                    <figure class="block-4-image">
                                        <a href="{{ route('web.shop.product.details', $product->id) }}">
                                            <img class="img-fluid product-cover-image"
                                                src="{{ asset('product/cover_images/' . $product->cover_image) }}"
                                                alt="{{ basename($product->cover_image) }}">
                                        </a>
                                    </figure>
                                    <div class="block-4-text p-4">
                                        <h3><a
                                                href="{{ route('web.shop.product.details', $product->id) }}">{{ $product->name }}</a>
                                        </h3>
                                        <p class="mb-0">{!! Str::limit($product->description, 40) !!}</p>
                                        <p class="text-primary font-weight-bold">${{ $product->amount }}</p>
                                        <b>Stock: </b> <span>{{$product->stock_status}}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                    @if (!empty($products))
                        <div class="d-flex justify-content-center mt-2 text-dark">
                            {!! $products->links('pagination::simple-bootstrap-4') !!}
                        </div>
                        <div class="text-center mb-2 text-dark">
                            Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of
                            {{ $products->total() }}
                        </div>
                    @endif
                </div>

                <div class="col-md-3 order-1 mb-5 mb-md-0">
                    <div class="border p-4 rounded mb-4">
                        <h3 class="mb-3 h6 text-uppercase text-black d-block">Categories</h3>
                        <ul class="list-unstyled mb-0">
                            @foreach ($categories as $category)
                                <li class="mb-1"><a href="{{ route('web.shop.category.sucategory', $category->name) }}"
                                        class="d-flex"><span>{{ $category->name }}</span>
                                        <span class="text-black ml-auto">({{ $category->products->count() }})</span></a>
                                </li>
                            @endforeach

                        </ul>
                    </div>

                    <div class="border p-4 rounded mb-4">
                        <div class="mb-4">
                            <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>
                            <div id="slider-range" class="border-primary"></div>
                            <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white"
                                disabled="" />
                        </div>

                        <div class="mb-4">
                            <h3 class="mb-3 h6 text-uppercase text-black d-block">Size</h3>
                            <label for="s_sm" class="d-flex">
                                <input type="checkbox" id="s_sm" class="mr-2 mt-1"> <span class="text-black">Small
                                    (2,319)</span>
                            </label>
                            <label for="s_md" class="d-flex">
                                <input type="checkbox" id="s_md" class="mr-2 mt-1"> <span class="text-black">Medium
                                    (1,282)</span>
                            </label>
                            <label for="s_lg" class="d-flex">
                                <input type="checkbox" id="s_lg" class="mr-2 mt-1"> <span class="text-black">Large
                                    (1,392)</span>
                            </label>
                        </div>

                        <div class="mb-4">
                            <h3 class="mb-3 h6 text-uppercase text-black d-block">Color</h3>
                            <a href="#" class="d-flex color-item align-items-center">
                                <span class="bg-danger color d-inline-block rounded-circle mr-2"></span> <span
                                    class="text-black">Red (2,429)</span>
                            </a>
                            <a href="#" class="d-flex color-item align-items-center">
                                <span class="bg-success color d-inline-block rounded-circle mr-2"></span> <span
                                    class="text-black">Green (2,298)</span>
                            </a>
                            <a href="#" class="d-flex color-item align-items-center">
                                <span class="bg-info color d-inline-block rounded-circle mr-2"></span> <span
                                    class="text-black">Blue (1,075)</span>
                            </a>
                            <a href="#" class="d-flex color-item align-items-center">
                                <span class="bg-primary color d-inline-block rounded-circle mr-2"></span> <span
                                    class="text-black">Purple (1,075)</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="site-section site-blocks-2">
                        <div class="row justify-content-center text-center mb-5">
                            <div class="col-md-7 site-section-heading pt-4">
                                <h2>Categories</h2>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($categories as $category)
                            <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
                                <a class="block-2-item " href="{{route('web.shop.category.sucategory', urlencode($category->name))}}">
                                    <figure class="image category-image">
                                        <img src="{{asset('product/category/images/' . $category->image)}}" alt="{{basename($category->image)}}" class="img-fluid">
                                    </figure>
                                    <div class="text">
                                        <span class="text-uppercase">Collections</span>
                                        <h3>{{$category->name}}</h3>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                          
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection