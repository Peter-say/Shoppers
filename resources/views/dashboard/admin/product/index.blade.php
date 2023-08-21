@extends('dashboard.admin.layouts.app')

@section('contents')
    <!-- MAIN CONTENT-->

    <style>
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination .page-item {
            margin: 0 5px;
            list-style: none;
            display: inline-block;
        }

        .pagination .page-item .page-link {
            color: blue;
            border: 1px solid blue;
            padding: 5px 10px;
            text-decoration: none;
        }

        .pagination .page-item .page-link:hover {
            background-color: blue;
            color: white;
        }

        .pagination .page-item.active .page-link {
            background-color: blue;
            color: white;
        }
    </style>


    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between">
                            <h2 class="title-1 m-b-25">Product Lists</h2>
                            <span><a href="{{ route('admin.dashboard.product.create') }}" class="btn btn-primary">Add
                                    New</a></span>
                        </div>

                        <div class="d-flex justify-content-center mb-3">
                            <livewire:search-component />
                        </div>
                        <div class="table-responsive table--no-card m-b-40">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr>
                                        <th>Date Created</th>
                                        <th>Order ID</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th class="">Description</th>
                                        <th class="">Amount Sold</th>
                                        <th class="">Discount</th>
                                        <th class="">Discount Percent</th>
                                        <th class="">Currency</th>
                                        <th class="">Brand</th>
                                        <th class="">Store</th>
                                        <th class="">Basic Unit</th>
                                        <th class="">Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->created_at->format('d-m-y-h:m') }}</td>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td class=" img-fluid"><img src="{{ asset('product/cover_images/'.$product->cover_image ?? 'N/A') }}"
                                                    alt=""></td>
                                            <td class="">{{ Str::limit($product->description, 50) }}</td>
                                            <td class="">{{ $product->currency->symbol }}{{ $product->amount }}</td>
                                            <td class="">
                                                {{ $product->currency->symbol }}{{ number_format($product->discount_price) ?? 'N/A' }}
                                            </td>
                                            <td class="">
                                                {{ number_format($product->discount_percent, 0) . '%' ?? 'N/A' }}
                                            </td>
                                            <td class="">{{ $product->currency->name }}</td>
                                            <td class="">{{ $product->brand->name }}</td>
                                            <td class="">{{ $product->Store->name ?? 'N/A' }}</td>
                                            <td class="">{{ $product->basic_unit ?? 'N/A' }}</td>
                                            <td class="">{{ $product->status }}</td>
                                            <td>
                                                <div class="d-flex justify-content-between">
                                                    <a href="{{ route('admin.dashboard.product.edit', $product->id) }}"><i
                                                            class="fa fa-edit"></i></a>
                                                    <form id="delete-product-form"
                                                        action="{{ route('admin.dashboard.product.destroy', $product->id) }}"
                                                        method="post">
                                                        @csrf @method('DELETE')
                                                    </form>
                                                    <a onclick="confirmDelete()">
                                                        <i class="fa fa-trash"></i>
                                                    </a>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
            {{-- <div class="pagination">
                {{ $products->links() }}
            </div> --}}
        </div>
        @if (session()->has('success_message'))
            <div class="popup-message success" id="popup-message">
                <p class="text-white">{{ session('success_message') }}</p>
            </div>
        @endif

    </div>
    <!-- END MAIN CONTENT-->
@endsection
