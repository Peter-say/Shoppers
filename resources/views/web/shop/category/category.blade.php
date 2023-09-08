@extends('web.layouts.app')

<style>
    .image {
        width: 300px;
        height: 300px;
        margin: 8px 10px 10px;
    }
</style>
@section('contents')
    <div class="site-blocks-cover" style="background-image: url({{ $web_assets }}/images/hero_1.jpg);" data-aos="fade">
        <div class="container">
            <div class="row align-items-start align-items-md-center justify-content-end">
                <div class="col-md-5 text-center text-md-left pt-5 pt-md-0">
                    <h1 class="mb-2">Finding by Category</h1>
                    <div class="intro-text text-center text-md-left">
                        <p class="mb-4">These are groups of categories we deals with in this shop. Feel free to scroll
                            through to find what your are looking for </p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="site-section site-blocks-2">
        <div class="container">
            <div class="row">

                @foreach ($categories as $category)
                    <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
                        <a class="block-2-item"
                            href="{{ route('web.shop.category.sucategory', urlencode($category->name)) }}">
                            <figure class="image">
                                <img src="{{ asset('product/category/images/'.$category->image) }}" alt="{{basename($category->image)}}" class="img-fluid">
                            </figure>
                            <div class="text">
                                <span class="text-uppercase">Collections</span>
                                <h3>{{ $category->name }}</h3>
                            </div>
                        </a>
                    </div>
                @endforeach


            </div>
        </div>
    </div>

     @include('web.shop.fragment.featured-products')
@endsection
