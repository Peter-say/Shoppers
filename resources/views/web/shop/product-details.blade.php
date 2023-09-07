@extends('web.layouts.app')

@section('contents')

    @livewire('add-to-cart', ['id' => $product->id])

    <div class="site-section block-3 site-blocks-2 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 site-section-heading text-center pt-4">
                    <h2>Related Products</h2>
                </div>
            </div>
            <div class="row">
                @if ($related_products->count())
                    @foreach ($related_products as $related)
                        <div class="col-sm-6 col-lg-4 mb-4 related-cover" data-aos="fade-up">
                            <div class="block-4 text-center border">
                                <figure class="block-4-image ">
                                    <a href="{{ route('web.shop.product.details', $related->id) }}">
                                        <img class="img-fluid "
                                            src="{{ asset('product/cover_images/' . $related->cover_image) }}"
                                            alt="{{ basename($related->cover_image) }}"></a>
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a
                                            href="{{ route('web.shop.product.details', $related->id) }}">{{ $related->name }}</a>
                                    </h3>
                                    <p class="mb-0">{{ Str::limit($related->description, 20) }}</p>
                                    <p class="text-primary font-weight-bold">${{ $related->amount }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="justify-content-center">
                        <p>No Related Items Available</p>
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

                        @foreach ($featuredProducts as $featured)
                            <div class="item">
                                <div class="block-4 text-center">
                                    <figure class="block-4-image">
                                        <img src="{{ asset('product/cover_images/' . $featured->cover_image) }}"
                                            alt="{{ basename($featured->cover_image) }}" class="img-fluid">
                                    </figure>
                                    <div class="block-4-text p-4">
                                        <h3><a
                                                href="{{ route('web.shop.product.details', $featured->id) }}">{{ $featured->name }}</a>
                                        </h3>
                                        <p class="mb-0">{{ $featured->meta_description }}</p>
                                        <p class="text-primary font-weight-bold">
                                            {{ $featured->currency->symbol }}{{ $featured->amount }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    </div>
@endsection
