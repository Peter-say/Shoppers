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
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            max-width: 600px;
            /* Adjust the width as needed */
        }

        .bottom-section {
            /* Style the bottom section */
            position: absolute;
            bottom: 0;
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

        /* ... Existing styles ... */

        /* Style for the image inside the container */
        .img-container {
            max-width: 100%;
            max-height: 300px;
            overflow: hidden;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .img-container img {
            width: auto;
            height: auto;
            max-width: 100%;
            max-height: 100%;
        }


        .text-black {
            color: #000;
        }

        .text-primary {
            color: #007bff;
        }

        .h4 {
            font-size: 1.5rem;
        }

        .overlay {
            /* Existing styles for the overlay including backdrop blur effect */
        }

        .container-popup {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            max-width: 600px;
            /* Adjust the width as needed */
        }
    </style>

    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="{{ route('web.shop.index') }}">Home</a> <span
                        class="mx-2 mb-0">/</span>
                    <strong class="text-black">{{ $product->name }}</strong>
                </div>
            </div>

        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="d-flex justify-content-end">
                @if ($product->id)
                    <form wire:click.prevent="addToWishlist({{ $product->id }})" method="post" id="wishlistForm">
                        <span class=" pl-5 icon  fa-lg icon-heart-o"></span>
                    </form>
                @else
                    <form wire:click.prevent="removeFromWishlist({{ $product->id }})" method="post" id="wishlistForm">
                        <span class=" pl-5 icon bg-primary fa-lg icon-heart-o"></span>
                    </form>
                @endif
            </div>
            <form method="post">
                @csrf
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <img class="img-fluid " src="{{ asset($product->cover_image) }}" alt="Image placeholder">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <h2 class="text-black">{{ $product->name }}</h2>
                        <p>{{ $product->description }}</p>
                        <p><strong
                                class="text-primary h4">{{ $product->currency->symbol }}{{ $product->amount }}</strong>
                        </p>
                        @if (!$product->cartItem)
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
                                    <input type="text" name="quantity" class="form-control text-center"
                                        value="1" placeholder="Enter Quantity"
                                        aria-label="Example text with button addon" aria-describedby="button-addon1"
                                        wire:model="quantity">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary js-btn-plus"
                                            wire:click="incrementQuantity()" type="button">&plus;</button>
                                    </div>
                                    @error('quantity')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        <div class="d-flex ">
                            <input type="hidden" value="{{ $product->price }}" name="price" wire:model="price">
                            @if ($product->cartItem == true)
                                <button wire:click.prevent="removeFromCart({{ $product->id }})"
                                    class="buy-now btn btn-sm btn-primary" id="remove-from-cart-button">Remove from
                                    cart</button>
                            @else
                                <button wire:click.prevent="addToCart({{ $product->id }})"
                                    class="buy-now btn btn-sm btn-primary" id="add-to-cart-button">Add to cart</button>
                            @endisset

                    </div>
                </div>
        </form>
    </div>
</div>



@if (session()->has('success_message'))
    <div class="popup-message success" id="popup-message">
        <p class="text-white">{{ session('success_message') }}</p>
    </div>

    @if (session()->has('success_message') && !session()->has('item_removed') && !session()->has('add-wishlist'))
        <div class="overlay">
            <div class="container-popup">
                <div class="row">
                    <div class="col-12">
                        <div class="popup-message success" id="popup-message">
                            <p class="text-white">{{ session('success_message') }}</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <img class="img-fluid" src="{{ asset($product->cover_image) }}" alt="Image placeholder">
                    </div>
                    <div class="col-8">
                        <div class="text-black">
                            <h5>{{ $product->name }}</h5>
                        </div>
                        <div class="">

                            <span class="text-black">
                                <b>Price:</b>
                                <b>{{ $product->currency->symbol }}{{ $product->amount }}</b>
                            </span>
                        </div>
                        <div class="bottom-section">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('web.shop.cart') }}"
                                    class="btn btn-primary btn-sm text-sm">Checkout</a>
                                <span>
                                    <a href="{{ route('web.shop.index') }}"
                                        class="btn btn-primary btn-sm text-sm">Continue Shopping</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endif



<div class="site-section block-3 site-blocks-2 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 site-section-heading text-center pt-4">
                <h2>Featured Products</h2>
            </div>
        </div>
        <div class="row">

            <div class="col-md-12">
                @foreach ($related_products as $related)
                    <div class=" nonloop-block-3 owl-carousel">
                        <div class="item">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="images/cloth_1.jpg" alt="Image placeholder" class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">{{ $related->name }}</a></h3>
                                    <p class="mb-0">{{ Str::limit($related->description, 40) }}</p>
                                    <p class="text-primary font-weight-bold">${{ $related->amount }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </div>

    @if (session()->has('error_message'))
        <div class="popup-message error" id="popup-message">
            <p class="text-white">{{ session('error_message') }}</p>
        </div>
    @endif

</div>
