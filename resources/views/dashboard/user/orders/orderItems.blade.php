@extends('web.layouts.app')


@section('contents')
    <style>
        .show-cart-image {
            width: 50px;
            height: 50px;
        }
    </style>
    <div class="site-section">
        <div class="container">
           
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="d-flex justify-content-center">
                        <h5>{{ 'Order Items Information' }}</h5>
                    </div>
                </div>
                <form class="col-md-12" wire:submit.prevent="removeFromCart">
                    <div class="site-blocks-table">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Image</th>
                                    <th class="product-name">Name</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-price">Quantity</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderItems as $items => $orderItem)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="{{ asset('product/cover_images/'.$orderItem->product->cover_image) }}"
                                                data-lightbox="product-gallery">
                                                <img src="{{ asset('product/cover_images/'.$orderItem->product->cover_image) }}" alt="Image"
                                                    class="img-fluid show-cart-image">
                                            </a>
                                        </td>

                                        <td class="product-name">
                                            <h2 class="h5 text-black">{{ $orderItem->product->name }}</h2>
                                        </td>
                                        <td>${{ $orderItem->price }}</td>
                                        <td>{{ $orderItem->quantity }}</td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </form>

            </div>

            @if (session()->has('success_message'))
                <div class="popup-message success" id="popup-message">
                    <p class="text-white">{{ session('success_message') }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection
