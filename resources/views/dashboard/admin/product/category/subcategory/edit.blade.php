@extends('dashboard.admin.layouts.app')

@section('contents')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="col-md-12 mb-3">
                <div class="overview-wrap justify-content-center">
                    <h2 class="title-1">Edit This SubCategory</h2>
                </div>
            </div>
            <div class="container-fluid au-card mb-2 col-8">
                <form action="{{ route('admin.dashboard.subcategory.update', $subcategory->id) }}"
                    enctype="multipart/form-data" method="post">
                    @csrf @method('PUT')
                    <div class="row justify-content-center">
                        <!-- Use justify-content-center class here -->

                        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Name<span
                                        class="required"></span></label>
                                <input id="cc-payment" type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" required
                                    value="{{ old('name') ?? $subcategory->name }}" placeholder="Enter Name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Image<span
                                        class="required"></span></label>
                                <input id="cc-payment"type="file" name="image"
                                    class="form-control @error('image') is-invalid @enderror"
                                    value="{{ old('image') ?? $subcategory->image }}" placeholder="upload image">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Status<span
                                        class="required"></span></label>
                                <select id="status" name="status"
                                    class="form-control  @error('status') is-invalid @enderror" required>
                                    <option value="">Select Status</option>
                                    @foreach ($statusOptions as $status)
                                        <option value="{{ $status }}" {{ old('status', $subcategory->status) == $status ? 'selected' : '' }}>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
                            <div class="form-group">
                                <button class="btn btn-primary btn-md w-100">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
    <!-- END MAIN CONTENT-->
@endsection
