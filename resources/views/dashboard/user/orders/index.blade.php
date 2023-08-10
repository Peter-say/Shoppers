@extends('web.layouts.app')


@section('contents')
<div class="site-section">
    <div class="container">
        <div class="row mb-5 d-flex justify-content-center">
            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 mb-3">
                <div class="border p-4 rounded" role="alert">
                    <div class="d-flex justify-content-center">
                        <p class="text-dark"> Your Orders <sup id="user-order-count">{{ $totalOrderCount }}</sup> </p>

                    </div>
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
                            </tbody>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
