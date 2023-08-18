@extends('web.layouts.app')

@section('contents')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="{{ route('user.dashboard.home') }}">Home</a> <span
                        class="mx-2 mb-0">/</span>
                    <strong class="text-black">wishlist</strong>
                </div>
            </div>
        </div>

    </div>


    <div>
        <style>
            .show-wishlist-image {
                width: 50px;
                height: 50px;
            }
        </style>
        <div class="site-section">
            <div class="container">
               @livewire('wishlist', ['wishlist' =>$wishlist])
            </div>
        </div>
    </div>



@endsection
