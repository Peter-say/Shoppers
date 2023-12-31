@extends('dashboard.admin.layouts.app')

@section('contents')
    <!-- MAIN CONTENT-->
    <style>
        .category-list-image {
            width: 60px;
            height: 60px;
        }

        #style-option {
            border-radius: 10px;
            font-size: 18px
        }
    </style>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between">
                            <h2 class="title-1 m-b-25">Category Lists</h2>
                            <span><a href="{{ route('admin.dashboard.product-category.create') }}" class="btn btn-primary">Add
                                    New</a></span>
                        </div>

                        <div class="table-responsive table--no-card m-b-40">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr>
                                        <th>Date Created</th>
                                        <th> ID</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->created_at->format('d-m-y-h:m') }}</td>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}
                                            </td>
                                            <td class="category-list-image">
                                                <a href="{{ asset('product/category/images/' . $category->image ?? 'N/A') }}" data-lightbox="">
                                                    <img class=" img-fluid" src="{{ asset('product/category/images/' . $category->image ?? 'N/A') }}"
                                                        alt="">
                                                </a>
                                            </td>
                                            <td>{{ $category->status }}</td>
                                            <td>
                                                <div class="d-flex justify-content-around">
                                                    <a
                                                        href="{{ route('admin.dashboard.product-category.edit', $category->id) }}"><i
                                                            class="fa fa-edit" title="Edit"></i></a>
                                                    <form id="delete-category-form"
                                                        action="{{ route('admin.dashboard.product-category.destroy', $category->id) }}"
                                                        method="post">
                                                        @csrf @method('DELETE')
                                                    </form>
                                                    <a onclick="confirmDelete()" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    <a href="{{ route('admin.dashboard.create.subcategory', $category->id) }}"
                                                        title="Add Subcategory" class="">
                                                        <i class="fa fa-folder"></i></a>
                                                </div>
                                                <div class="">
                                                    <select class="mt-2 d-flex justify-content-center select"
                                                        style="border-radius: 20px; padding:10px" name="subcategories"
                                                        id="subcategories">
                                                        <option value="" disabled selected>View Subcategory</option>
                                                        @if (count($category->children))
                                                            @foreach ($category->children as $subcategory)
                                                                <option id="style-option" value="{{ $subcategory->id }}">
                                                                    <a
                                                                        href="{{ route('admin.dashboard.subcategory.edit', $subcategory->id) }}">
                                                                        {{ $subcategory->name }} <span> <a href="{{ asset($subcategory->image ?? 'N/A') }}" data-lightbox="">
                                                                            <img class=" img-fluid" src="{{ asset('product/category/subcategory/images/' . $subcategory->image ?? 'N/A') }}"
                                                                                alt="image">
                                                                        </a></span>
                                                                    </a>
                                                                </option>
                                                            @endforeach
                                                        @else
                                                            <option value="" disabled>Not available
                                                            </option>
                                                        @endif
                                                    </select>
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
