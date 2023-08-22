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
                    <h1 class="mb-2">Finding by {{ $category->name }}</h1>
                    <div class="intro-text text-center text-md-left">
                        <p class="mb-4">These are collecion of categories that belong to {{ $category->name }}. Feel free
                            to scroll
                            through to find what your are looking for </p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="site-section site-blocks-2">
        <div class="container">
            <div class="row">

                @if ($category->children->count())
                    @foreach ($category->children as $subcategory)
                        <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
                            <a class="block-2-item"
                                href="{{ route('web.shop.category.products', [$category->name, 'name' => $subcategory->name]) }}">
                                <figure class="image">
                                    <img src="{{ asset('product/subcategory/images/'.$subcategory->image) }}" alt="" class="img-fluid">
                                </figure>
                                <div class="text">
                                    <span class="text-uppercase">Collections</span>
                                    <h3>{{ $subcategory->name }}</h3>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class=" d-flex justify-content-center">
                        <h4> No collection at the momment</h4>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <div class="site-section block-3 site-blocks-2 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 site-section-heading text-center pt-4">
                    <h2>Featured Products</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="nonloop-block-3 owl-carousel">
                        <div class="item">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="{{ $web_assets }}/images/cloth_1.jpg" alt="Image placeholder"
                                        class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">Tank Top</a></h3>
                                    <p class="mb-0">Finding perfect t-shirt</p>
                                    <p class="text-primary font-weight-bold">$50</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="{{ $web_assets }}/images/shoe_1.jpg" alt="Image placeholder"
                                        class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">Corater</a></h3>
                                    <p class="mb-0">Finding perfect products</p>
                                    <p class="text-primary font-weight-bold">$50</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="{{ $web_assets }}/images/cloth_2.jpg" alt="Image placeholder"
                                        class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">Polo Shirt</a></h3>
                                    <p class="mb-0">Finding perfect products</p>
                                    <p class="text-primary font-weight-bold">$50</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="{{ $web_assets }}/images/cloth_3.jpg" alt="Image placeholder"
                                        class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">T-Shirt Mockup</a></h3>
                                    <p class="mb-0">Finding perfect products</p>
                                    <p class="text-primary font-weight-bold">$50</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="{{ $web_assets }}/images/shoe_1.jpg" alt="Image placeholder"
                                        class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">Corater</a></h3>
                                    <p class="mb-0">Finding perfect products</p>
                                    <p class="text-primary font-weight-bold">$50</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
