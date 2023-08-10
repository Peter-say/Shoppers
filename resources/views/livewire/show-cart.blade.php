<div>
    <style>
        .show-cart-image {
            width: 50px;
            height: 50px;
        }
    </style>
    <div class="site-section">
        <div class="container">
            @if ($cartItems == null)
                <div class="d-flex justify-content-around">
                    <h4>You have not added any items to cart yet</h4> <span>
                        <a href="{{ route('web.shop.index') }}" class="btn btn-primary">Go shopping!</a>
                    </span>
                </div>
            @else
                <div class="row mb-5">
                    <form class="col-md-12" wire:submit.prevent="removeFromCart">
                        <div class="site-blocks-table">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Image</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-total">Total</th>
                                        <th class="product-remove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item => $cartItem)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <a href="{{ asset($cartItem->product->cover_image) }}"
                                                    data-lightbox="product-gallery">
                                                    <img src="{{ asset($cartItem->product->cover_image) }}"
                                                        alt="Image" class="img-fluid show-cart-image">
                                                </a>
                                            </td>

                                            <td class="product-name">
                                                <h2 class="h5 text-black">{{ $cartItem->product->name }}</h2>
                                            </td>
                                            <td>${{ $cartItem->price }}</td>
                                            <td>
                                                <div class="input-group mb-3" style="max-width: 120px;">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-outline-primary js-btn-minus"
                                                            type="button"
                                                            wire:click="decrementQuantity({{ $item }})">&minus;</button>
                                                    </div>
                                                    <input type="text" class="form-control text-center" disabled
                                                        value="{{ $cartItem->quantity }}" placeholder=""
                                                        aria-label="Example text with button addon"
                                                        aria-describedby="button-addon1">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-primary js-btn-plus"
                                                            type="button"
                                                            wire:click="incrementQuantity({{ $item }})">&plus;</button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>${{ $cartItem->price * $cartItem->quantity }}</td>
                                            <td><button type="button" wire:click="removeFromCart({{ $item }})"
                                                    class="btn btn-primary btn-sm">X</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </form>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-5">

                            <div class="col-md-6 mb-3 mb-md-0">
                                <form wire:submit.prevent="updateCartItems">
                                    <button type="button" wire:click="updateCartItems()"
                                        class="btn btn-primary btn-sm btn-block">Update Cart</button>
                                </form>
                            </div>

                            <div class="col-md-6">
                                <a href="{{ route('web.shop.index') }}"
                                    class="btn btn-outline-primary btn-sm btn-block">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="text-black h4" for="coupon">Coupon</label>
                                <p>Enter your coupon code if you have one.</p>
                            </div>
                            <div class="col-md-8 mb-3 mb-md-0">
                                <input type="text" class="form-control py-3" id="coupon"
                                    placeholder="Coupon Code">
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary btn-sm">Apply Coupon</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pl-5">
                        <div class="row justify-content-end">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12 text-right border-bottom mb-5">
                                        <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                    </div>
                            </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <span class="text-black">Subtotal</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong class="text-black">$ {{ $totalPrice }}</strong>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-6">
                                        <span class="text-black">Total</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong class="text-black">$ {{ $totalPrice }}</strong>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary btn-lg py-3 btn-block"
                                            onclick="redirectToCheckout()">Proceed To Checkout</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if (session()->has('success_message'))
                <div class="popup-message success" id="popup-message">
                    <p class="text-white">{{ session('success_message') }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
