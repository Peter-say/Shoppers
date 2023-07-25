@extends('web.layouts.app')

@section('contents')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="{{ route('web.shop.index') }}">Home</a> <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">Cart</strong>
                </div>
            </div>
        </div>

    </div>


    @livewire('show-cart')

    <script>
        function redirectToCheckout() {
            if ({{ Auth::check() ? 'true' : 'false' }}) {
                window.location = '{{ route('user.dashboard.checkout') }}';
            } else {
                // Store the current URL in the session
                sessionStorage.setItem('redirectUrl', window.location.href);
                window.location = '{{ route('login') }}';
            }
        }
    </script>
@endsection
