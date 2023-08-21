@extends('web.layouts.app')
<style>
    .radio-check-input {
        width: 20px;
        height: 20px;
        margin-right: 20px;

    }
</style>

@section('contents')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="{{ route('user.dashboard.home') }}">Home</a> <span
                        class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong>
                </div>
            </div>
        </div>
    </div>

    @if (session()->has('success_message'))
        <div class="popup-message success" id="popup-message">
            <p class="text-white">{{ session('success_message') }}</p>
        </div>
    @endif

    @if (session()->has('error_message'))
        <div class="popup-message error" id="popup-message">
            <p class="text-white">{{ session('error_message') }}</p>
        </div>
    @endif

    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="border p-4 rounded" role="alert">
                        Returning customer? <a href="#">Click here</a> to login
                    </div>
                </div>
            </div>
            <div class="row">

                @include('dashboard.user.cart.shipping-address', ['shipping_address', $shipping_address])

                <div class="col-md-6">

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Coupon Code</h2>
                            <div class="p-3 p-lg-5 border">

                                <label for="c_code" class="text-black mb-3">Enter your coupon code if you have
                                    one</label>
                                <div class="input-group w-75">
                                    <input type="text" class="form-control" id="c_code" placeholder="Coupon Code"
                                        aria-label="Coupon Code" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary btn-sm" type="button"
                                            id="button-addon2">Apply</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Your Order</h2>
                            <div class="p-3 p-lg-5 border">
                                <table class="table site-block-order-table mb-5">
                                    <thead>
                                        <th>Product</th>
                                        <th>Total</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartItems as $cartItem)
                                            <tr>
                                                <td>{{ $cartItem->product->name }} <strong
                                                        class="mx-2">x</strong>{{ $cartItem->quantity }}</td>
                                                <td>${{ $cartItem->price * $cartItem->quantity }}</td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                            <td class="text-black font-weight-bold" id="total-price">
                                                <strong>${{ $totalPrice }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <form id="payment-form" action="{{ route('user.dashboard.place-order') }}" method="post">
                                    @csrf
                                    <div class="m-2">

                                        <div class="d-flex flex-row pb-3">
                                            <div class="d-flex align-items-center pe-2">
                                                <input class="radio-check-input" id="wallet-check-input" type="radio"
                                                    name="payment_method" value="wallet" id="radioNoLabel1" value=""
                                                    aria-label="..." checked />
                                            </div>
                                            <div class="rounded border d-flex w-100 p-3 align-items-center">

                                                <div class="ms-auto"><svg xmlns="http://www.w3.org/2000/svg" height="2em"
                                                        viewBox="0 0 512 512">
                                                        <path
                                                            d="M461.2 128H80c-8.84 0-16-7.16-16-16s7.16-16 16-16h384c8.84 0 16-7.16 16-16 0-26.51-21.49-48-48-48H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h397.2c28.02 0 50.8-21.53 50.8-48V176c0-26.47-22.78-48-50.8-48zM416 336c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32z" />
                                                    </svg><span class="m-2"><b>Pay With Wallet</b></span></div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <div class="d-flex align-items-center pe-2">
                                                <input class="radio-check-input" id="stripe-check-input" type="radio"
                                                    name="payment_method" value="stripe-card" id="radioNoLabel2"
                                                    value="" aria-label="..." />
                                            </div>
                                            <div class="rounded border d-flex w-100 p-3 align-items-center">

                                                <div class="ms-auto"><svg xmlns="http://www.w3.org/2000/svg" height="2em"
                                                        viewBox="0 0 576 512">
                                                        <path
                                                            d="M186.3 258.2c0 12.2-9.7 21.5-22 21.5-9.2 0-16-5.2-16-15 0-12.2 9.5-22 21.7-22 9.3 0 16.3 5.7 16.3 15.5zM80.5 209.7h-4.7c-1.5 0-3 1-3.2 2.7l-4.3 26.7 8.2-.3c11 0 19.5-1.5 21.5-14.2 2.3-13.4-6.2-14.9-17.5-14.9zm284 0H360c-1.8 0-3 1-3.2 2.7l-4.2 26.7 8-.3c13 0 22-3 22-18-.1-10.6-9.6-11.1-18.1-11.1zM576 80v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h480c26.5 0 48 21.5 48 48zM128.3 215.4c0-21-16.2-28-34.7-28h-40c-2.5 0-5 2-5.2 4.7L32 294.2c-.3 2 1.2 4 3.2 4h19c2.7 0 5.2-2.9 5.5-5.7l4.5-26.6c1-7.2 13.2-4.7 18-4.7 28.6 0 46.1-17 46.1-45.8zm84.2 8.8h-19c-3.8 0-4 5.5-4.2 8.2-5.8-8.5-14.2-10-23.7-10-24.5 0-43.2 21.5-43.2 45.2 0 19.5 12.2 32.2 31.7 32.2 9 0 20.2-4.9 26.5-11.9-.5 1.5-1 4.7-1 6.2 0 2.3 1 4 3.2 4H200c2.7 0 5-2.9 5.5-5.7l10.2-64.3c.3-1.9-1.2-3.9-3.2-3.9zm40.5 97.9l63.7-92.6c.5-.5.5-1 .5-1.7 0-1.7-1.5-3.5-3.2-3.5h-19.2c-1.7 0-3.5 1-4.5 2.5l-26.5 39-11-37.5c-.8-2.2-3-4-5.5-4h-18.7c-1.7 0-3.2 1.8-3.2 3.5 0 1.2 19.5 56.8 21.2 62.1-2.7 3.8-20.5 28.6-20.5 31.6 0 1.8 1.5 3.2 3.2 3.2h19.2c1.8-.1 3.5-1.1 4.5-2.6zm159.3-106.7c0-21-16.2-28-34.7-28h-39.7c-2.7 0-5.2 2-5.5 4.7l-16.2 102c-.2 2 1.3 4 3.2 4h20.5c2 0 3.5-1.5 4-3.2l4.5-29c1-7.2 13.2-4.7 18-4.7 28.4 0 45.9-17 45.9-45.8zm84.2 8.8h-19c-3.8 0-4 5.5-4.3 8.2-5.5-8.5-14-10-23.7-10-24.5 0-43.2 21.5-43.2 45.2 0 19.5 12.2 32.2 31.7 32.2 9.3 0 20.5-4.9 26.5-11.9-.3 1.5-1 4.7-1 6.2 0 2.3 1 4 3.2 4H484c2.7 0 5-2.9 5.5-5.7l10.2-64.3c.3-1.9-1.2-3.9-3.2-3.9zm47.5-33.3c0-2-1.5-3.5-3.2-3.5h-18.5c-1.5 0-3 1.2-3.2 2.7l-16.2 104-.3.5c0 1.8 1.5 3.5 3.5 3.5h16.5c2.5 0 5-2.9 5.2-5.7L544 191.2v-.3zm-90 51.8c-12.2 0-21.7 9.7-21.7 22 0 9.7 7 15 16.2 15 12 0 21.7-9.2 21.7-21.5.1-9.8-6.9-15.5-16.2-15.5z" />
                                                    </svg><span class="m-2 "><b>Pay With Stripe</b></span></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" id="pay-with-wallet-button">
                                        <button id="proceed-to-pay-modal-button"
                                            class="btn btn-primary btn-lg py-3 btn-block " data-toggle="modal"
                                            data-target="#WalletModal">Proceed to pay
                                        </button>
                                    </div>
                                    <div class="form-group" id="pay-with-stripe-button">
                                        <button onclick="initiatePaymentForStripe(event)"
                                            class="btn btn-primary btn-lg py-3 btn-block">Continue with Stripe
                                        </button>
                                    </div>
                                    @include('dashboard.user.wallet.modal')

                                </form>
                                <form id="stripe-checkout-form" action="{{ route('user.dashboard.stripe.checkout') }}"
                                    enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <input type="hidden" name="amount" id="amount-input">
                                    <input type="hidden" name="payment_method"> <!-- Add this hidden input field -->
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function initiatePaymentForStripe(event) {
                    event.preventDefault();

                    // Get the selected payment method
                    var paymentMethod = document.querySelector('#stripe-check-input:checked').value;

                    // Get the total price
                    var totalPriceElement = document.querySelector('#total-price');
                    var totalPrice = parseFloat(totalPriceElement.textContent.replace('$', ''));

                    // Update the value of the hidden input field in the second form
                    var stripeForm = document.getElementById('stripe-checkout-form');
                    var amountInput = stripeForm.querySelector('[name="amount"]');
                    var paymentMethodInput = stripeForm.querySelector('[name="payment_method"]');

                    amountInput.value = totalPrice;
                    paymentMethodInput.value = paymentMethod;

                    // Submit the second form
                    stripeForm.submit();
                }
            </script>

        </div>
    </div>
@endsection
