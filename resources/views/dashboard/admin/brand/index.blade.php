@extends('dashboard.admin.layouts.app')

@section('contents')
    <!-- MAIN CONTENT-->

    <style>
        .brand-image {
            width: 50px;
            height: 50px;
        }
    </style>

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between">
                            <h2 class="title-1 m-b-25">Brand Lists</h2>
                            <span><a href="" class="btn btn-primary">Add
                                    New</a></span>
                        </div>

                        <div class="table-responsive table--no-card m-b-40">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr>
                                        <th>Date Created</th>
                                        <th>Name</th>
                                        <th>Logo</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($brands as $brand)
                                        <tr>
                                            <td class="">{{ $brand->created_at->format('d-m-y') }}</td>
                                            <td class="">{{ $brand->name }}</td>
                                            <td class="">
                                                <a href="{{ asset($brand->logo ?? 'N/A') }}" data-lightbox="">
                                                    <img class="img-fluid brand-image"
                                                        src="{{ asset($brand->logo) ?? 'N/A' }}" alt="brand-logo">
                                                </a>
                                            </td>
                                            <td class="">{{ $brand->status }}</td>
                                            <td class="">
                                                <div class="d-flex justify-content-between">
                                                    <a href="{{ route('admin.dashboard.brand.edit', $brand->id) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                    <form action="{{ route('admin.dashboard.brand.destroy', $brand->id) }}"
                                                        method="POST" id="deleteForm" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this brand?')">Delete</button>
                                                    </form>

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

        </div>
        @if (session()->has('success_message'))
            <div class="popup-message success" id="popup-message">
                <p class="text-white">{{ session('success_message') }}</p>
            </div>
        @endif

    </div>
    <!-- END MAIN CONTENT-->
@endsection
