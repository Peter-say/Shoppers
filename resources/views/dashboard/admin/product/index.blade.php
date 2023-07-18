@extends('dashboard.admin.layouts.app')

@section('contents')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

            </div>
        </div>
        @if (session()->has('success_message'))
            <div class="popup-message success" id="popup-message">
                <p class="text-white">{{ session('success_message') }}</p>
            </div>
        @endif
    </div>
    <!-- END MAIN CONTENT-->
@endsection
