<div>

    <style>
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Semi-transparent background */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            /* Make sure it's on top of other elements */
            backdrop-filter: blur(8px);
            /* Add the backdrop blur effect */
            -webkit-backdrop-filter: blur(8px);
            /* For Safari support */
        }

        .container-popup {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20vh;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            max-width: 600px;
            /* Adjust the width as needed */
        }

        .container-popup img {
            width: 100%;
            height: 100%;
        }

        @media (max-width: 768px) {
            .bottom-section .d-flex.justify-content-between a {
                width: 100%;
                margin-bottom: 10px;
            }

            .bottom-section .d-flex.justify-content-between a:nth-child(1) {
                display: block;
            }

            .bottom-section .d-flex.justify-content-between a:nth-child(2) {
                display: block;
            }
        }
        }

        .bottom-section {
            position: absolute;
            */ bottom: 0;
            left: 0;
            right: 0;
            padding: 10px 20px;
            background-color: #fff;
            border-top: 1px solid #ddd;
            border-radius: 0 0 8px 8px;
        }

        /* Additional styles for the buttons */
        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>

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

        .details-cover-image {
            position: relative;
            width: 100%;
            /* padding-top: 100%; */
            /* overflow: hidden; */
        }

        .details-cover-image img {

            width: 100%;
            height: 50%;
            object-fit: cover;
        }

        .price-and-discount {
            display: flex;
        }

        .price-and-discount p {
            padding: 10px;
        }
    </style>

    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="/">Home</a> <span
                        class="mx-2 mb-0">/</span><a href="{{ route('web.shop.index') }}">Shop</a> <span
                        class="mx-2 mb-0">/</span>
                    <strong class="text-black">{{ $product->name }}</strong>
                </div>
            </div>

        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="d-flex justify-content-end">

                {{-- @include('notifications.pop-up') --}}

                @if (Auth::check())
                    @php
                        $userWishlist = Auth::user()->wishlist;
                    @endphp

                    @if ($userWishlist->contains('product_id', $product->id))
                        <form wire:click.prevent="removeFromWishlist({{ $product->id }})" method="post"
                            id="wishlistForm" wire:key="remove-{{ $product->id }}">
                            <span style="cursor: pointer; color: red;" class="pl-5 icon fa-lg icon-heart-o"></span>
                        </form>
                    @else
                        <form wire:click.prevent="addToWishlist({{ $product->id }})" method="post" id="wishlistForm"
                            wire:key="add-{{ $product->id }}">
                            <span style="cursor: pointer" class="pl-5 icon fa-lg icon-heart-o"></span>
                        </form>
                    @endif

                @endif

            </div>
            <form method="post">
                @csrf
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 ">
                        <div class="details-cover-image">
                            <img class="img-fluid " src="{{ asset('product/cover_images/' . $product->cover_image) }}"
                                alt="{{ basename($product->cover_image) }}">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <h2 class="text-black">{{ $product->name }}</h2>
                        <p>{!! $product->description !!}</p>
                        <div class="price-and-discount">
                            <p><strong
                                    class="text-primary h4">{{ $product->currency->symbol }}{{ $product->amount }}</strong>
                            </p>
                            @if ($product->discount_price !== null)
                                <p><b class="text-dark h5"> <strike>{{ $product->currency->symbol }}
                                        {{ $product->discount_price }}</strike></b></p>
                            @endif
                        </div>
                        <div class="mb-1 d-flex">
                            <label for="option-sm" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;">
                                    <input type="radio" id="option-sm" name="size" value="small "
                                        wire:model="size">
                                </span>
                                <span class="d-inline-block text-black">Small</span>
                            </label>
                            <label for="option-md" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;">
                                    <input type="radio" id="option-md" name="size" value="medium"
                                        wire:model="size">
                                </span>
                                <span class="d-inline-block text-black">Medium</span>
                            </label>
                            <label for="option-lg" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;">
                                    <input type="radio" id="option-lg" name="size" value="large"
                                        wire:model="size">
                                </span>
                                <span class="d-inline-block text-black">Large</span>
                            </label>
                            <label for="option-xl" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;">
                                    <input type="radio" id="option-xl" name="size" value="extra_large"
                                        wire:model="size">
                                </span>
                                <span class="d-inline-block text-black">Extra Large</span>
                            </label>
                            @error('size')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <div class="input-group mb-3" style="max-width: 120px;">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-primary js-btn-minus"
                                        wire:click="decrementQuantity()" type="button">&minus;</button>
                                </div>
                                <input type="text" name="quantity" class="form-control text-center" value="0"
                                    placeholder="Enter Quantity" aria-label="Example text with button addon"
                                    aria-describedby="button-addon1" wire:model="quantity">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary js-btn-plus" wire:click="incrementQuantity()"
                                        type="button">&plus;</button>
                                </div>
                                @error('quantity')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        @if ($product->cartItem)
                            This product is already available in your cart. If you wish to add a new one, you can
                            continue.
                        @endif
                        <div class="d-flex ">
                            <input type="hidden" value="{{ $product->price }}" name="price" wire:model="price">
                            <button wire:click.prevent="addToCart({{ $product->id }})"
                                class="buy-now btn btn-sm btn-primary" id="add-to-cart-button">Add to
                                cart</button>

                        </div>
                    </div>
            </form>
        </div>
    </div>



    @if (session()->has('success_message') && !session()->has('item_removed') && !session()->has('add-wishlist'))
        <div class="overlay">
            <div class="container-popup">
                <div class="row">
                    <div class="col-12">
                        @include('notifications.pop-up')
                    </div>
                    <div class="col-4 container-popup-image">
                        <img class="img-fluid" src="{{ asset('product/cover_images/' . $product->cover_image) }}"
                            alt="{{ basename($product->cover_image) }}">
                    </div>
                    <div class="col-8">
                        <div class="text-black d-flex justify-content-between">
                            <h5>{{ $product->name }}</h5> <a href="{{ url()->previous() }}"
                                class="btn btn-secodary">Back</a>
                        </div>
                        <div class="">

                            <span class="text-black">
                                <b>Price:</b>
                                <b>{{ $product->currency->symbol }}{{ $product->amount }}</b>
                            </span>
                        </div>
                        <div class="bottom-section mt-5">
                            <div class="d-flex justify-content-between">

                                <a href="{{ route('web.shop.cart') }}"
                                    class="btn btn-primary btn-sm text-sm">Checkout</a>


                                <a href="{{ route('web.shop.index') }}"
                                    class="btn btn-primary btn-sm text-sm">Continue Shopping</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
