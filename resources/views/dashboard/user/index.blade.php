@extends('web.layouts.app')

<style>
    .fa-ellipsis-v {
        font-size: 10px;
        color: #C2C2C4;
        margin-top: 6px;
        cursor: pointer;
    }

    .text-dark {
        font-weight: bold;
        margin-top: 8px;
        font-size: 13px;
        letter-spacing: 0.5px;
    }

    .card-bottom {
        background: #3E454D;
        border-radius: 6px;
    }

    .flex-column {
        color: #adb5bd;
        font-size: 13px;
    }

    .flex-column p {
        letter-spacing: 1px;
        font-size: 18px;
    }

    .btn-secondary {
        height: 40px !important;
        margin-top: 3px;
    }

    .btn-secondary:focus {
        box-shadow: none;
    }
</style>

@section('contents')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><strong class="text-black">Welcome to your dashboard <span
                            class="text-primary">{{ Auth::user()->full_name }}</span></strong>
                </div>
            </div>
        </div>
    </div>
    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-3">
                    <div class="border p-4 rounded">

                        <p class="text-dark">Your Account Ballance</p>
                        <div class="card-bottom pt-3 px-3 mb-2">
                            <div class="d-flex flex-row justify-content-between text-align-center">
                                <div class="d-flex flex-column"><span>Balance amount</span>
                                    <p>{{ $wallet->symbol }}<span
                                            class="text-white">{{ number_format($wallet->balance) }}</span></p>
                                </div>
                                <a href="" class="btn btn-secondary">Manage</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="border p-4 rounded" role="alert">
                        Your Orders
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="border p-4 rounded" role="alert">
                        Cart Lists
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="border p-4 rounded" role="alert">
                        <h4>Transaction Details</h4>
                        <div style="overflow: auto; width:100%">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Item 1</td>
                                        <td>$10</td>
                                        <td>Pending</td>
                                        <td>06-07-2023</td>

                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Item 1</td>
                                        <td>$10</td>
                                        <td>Pending</td>
                                        <td>06-07-2023</td>

                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Item 1</td>
                                        <td>$10</td>
                                        <td>Pending</td>
                                        <td>06-07-2023</td>

                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Item 1</td>
                                        <td>$10</td>
                                        <td>Pending</td>
                                        <td>06-07-2023</td>

                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Item 1</td>
                                        <td>$10</td>
                                        <td>Pending</td>
                                        <td>06-07-2023</td>

                                    </tr>

                                </tbody>
                            </table>
                        </div>
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
    </div>
@endsection
