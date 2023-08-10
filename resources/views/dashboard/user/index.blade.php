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

    #user-order-count {
        background: #7971ea;
        color: white;
        padding: 6px;
        border-radius: 50%;
        font-size: 10px;
        width: 2px;
        height: 24px;




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
            {{-- <div class="row d-flex justify-content-end">
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-3">
                    <div class="border p-4 rounded">

                        <p class="text-dark">Your Account Ballance</p>
                        <div class="card-bottom pt-3 px-3 mb-2 justify-content-center">
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
            </div> --}}
            <div class="row mb-5">
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 mb-3">
                    <div class="border p-4 rounded" role="alert">
                        <div class="d-flex justify-content-center">
                            <p class="text-dark"> Your Orders <sup id="user-order-count">{{ $totalOrderCount }}</sup> </p>

                        </div>
                        @if ($transactions->count())
                            <div style="overflow: auto; width:100%">
                                <table class="table">

                                    <thead>
                                        <tr>
                                            <th>No. of Items</th>
                                            <th>Tracking No.</th>
                                            <th>Status</th>
                                            <th>Purchased Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($orders as $order)
                                            @php
                                                $orderStatus = $order->status;
                                                $orderStatusColor = '';
                                                
                                                if ($orderStatus == 'Completed') {
                                                    $orderStatusColor = 'text-success';
                                                }
                                                if ($orderStatus == 'Pending') {
                                                    $orderStatusColor = 'text-warning';
                                                }
                                                if ($orderStatus == 'Rejected') {
                                                    $orderStatusColor = 'text-danger';
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ number_format($order->total) }}</td>
                                                <td>{{ $order->tracking_number }}</td>
                                                <td class="{{ $orderStatusColor }}">{{ $order->status }}</td>
                                                <td>{{ $order->created_at->format('d-m-y') }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-between">
                                                        <a href="{{ route('user.dashboard.order.products', $order->id) }}"
                                                            class="btn btn-primary" >view</a>
                                                    </div>
                                                </td>
                                            </tr>
                               
                                        @endforeach


                                </table>
                                <div class="d-flex justify-content-center">
                                    <a href="{{route('user.dashboard.orders')}}" class="btn btn-primary btn-sm text-sm">View All</a>
                                </div>
                            @else
                                <div class="d-flex justify-content-center">
                                    <h6>You have not place an order yet.</h6>
                                </div>
                                </tbody>
                        @endif
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="border p-4 rounded" role="alert">
                    <div class="d-flex justify-content-center">
                        <h4>Transaction Details</h4>
                    </div>
                    <div style="overflow: auto; width:100%">
                        <table class="table">
                            @if ($transactions->count())
                                <thead>
                                    <tr>
                                        <th>No. of Items</th>
                                        <th>Description</th>
                                        <th>Reference No.</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>{{ number_format($transaction->order->total) }}<a href=""><small
                                                        class="pl-2">view</small></a> </td>
                                            <td>{{ $transaction->description ?? 'Not Available' }}</td>
                                            <td>{{ $transaction->reference_no }}</td>
                                            <td>${{ $transaction->amount }}</td>
                                            <td>{{ $transaction->status }}</td>
                                            <td>{{ $transaction->created_at }}</td>
                                            <td>
                                                <div class="d-flex justify-content-between">
                                                    <a href="" class="btn btn-primary">view</a>
                                                    <a href="" class="btn btn-danger">Discard</a>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                @else
                                    <div class="d-flex justify-content-center">
                                        <h6>No Transaction at the momment</h6>
                                    </div>


                                </tbody>
                            @endif

                        </table>

                    </div>

                </div>
                @if (!empty($transactions))
                    <div class="d-flex justify-content-center mt-2 text-dark">
                        {!! $transactions->links('pagination::simple-bootstrap-4') !!}
                    </div>
                    <div class="text-center mb-2 text-dark">
                        Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of
                        {{ $transactions->total() }}
                    </div>
                @endif
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
