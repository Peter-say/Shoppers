@extends('web.layouts.app')

<style>
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

    <div class="site-blocks-cover" style="background-image: url({{ $web_assets }}/images/hero_1.jpg);" data-aos="fade">
        <div class="container">
            <div class="row align-items-start align-items-md-center justify-content-end">
                <div class="col-md-5 text-center text-md-left pt-5 pt-md-0">
                    <h1 class="mb-2">Finding Your Perfect Shoes</h1>
                    <div class="intro-text text-center text-md-left">
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis
                            quam.
                            Integer accumsan tincidunt fringilla. </p>
                        <p>
                            <a href="#" class="btn btn-sm btn-primary">Shop Now</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            @if ($products->count())
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
                                            <a class="dropdown-item" href="#">Men</a>
                                            <a class="dropdown-item" href="#">Women</a>
                                            <a class="dropdown-item" href="#">Children</a>
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
                                                    href="{{ route('web.shop.product.details', $product->id) }}">{{ Str::limit($product->name, 40) }}</a>
                                            </h3>
                                            <p class="mb-0">{!! Str::limit($product->description, 20) !!}</p>
                                            <p class="text-primary font-weight-bold">${{ $product->amount }}</p>
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
                                <li class="mb-1"><a href="#" class="d-flex"><span>Men</span> <span
                                            class="text-black ml-auto">(2,220)</span></a></li>
                                <li class="mb-1"><a href="#" class="d-flex"><span>Women</span> <span
                                            class="text-black ml-auto">(2,550)</span></a></li>
                                <li class="mb-1"><a href="#" class="d-flex"><span>Children</span> <span
                                            class="text-black ml-auto">(2,124)</span></a></li>
                            </ul>
                        </div>

                        <div class="border p-4 rounded mb-4">
                            <div class="mb-4">
                                <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>
                                <div id="slider-range" class="border-primary"></div>
                                <input type="text" name="text" id="amount"
                                    class="form-control border-0 pl-0 bg-white" disabled="" />
                            </div>

                            <div class="mb-4">
                                <h3 class="mb-3 h6 text-uppercase text-black d-block">Size</h3>
                                <label for="s_sm" class="d-flex">
                                    <input type="checkbox" id="s_sm" class="mr-2 mt-1"> <span
                                        class="text-black">Small
                                        (2,319)</span>
                                </label>
                                <label for="s_md" class="d-flex">
                                    <input type="checkbox" id="s_md" class="mr-2 mt-1"> <span
                                        class="text-black">Medium
                                        (1,282)</span>
                                </label>
                                <label for="s_lg" class="d-flex">
                                    <input type="checkbox" id="s_lg" class="mr-2 mt-1"> <span
                                        class="text-black">Large
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
                @else
                    <div class="d-flex justify-content-center">
                        <h4>
                            No Products for this category at the momment!
                        </h4>
                    </div>

                </div>
            @endif
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
                        <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
                            <a class="block-2-item" href="#">
                                <figure class="image">
                                    <img src="images/women.jpg" alt="" class="img-fluid">
                                </figure>
                                <div class="text">
                                    <span class="text-uppercase">Collections</span>
                                    <h3>Women</h3>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="100">
                            <a class="block-2-item" href="#">
                                <figure class="image">
                                    <img src="images/children.jpg" alt="" class="img-fluid">
                                </figure>
                                <div class="text">
                                    <span class="text-uppercase">Collections</span>
                                    <h3>Children</h3>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="200">
                            <a class="block-2-item" href="#">
                                <figure class="image">
                                    <img src="images/men.jpg" alt="" class="img-fluid">
                                </figure>
                                <div class="text">
                                    <span class="text-uppercase">Collections</span>
                                    <h3>Men</h3>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    </div>
@endsection
