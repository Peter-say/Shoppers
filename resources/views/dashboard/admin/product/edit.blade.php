@extends('dashboard.admin.layouts.app')

@section('contents')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="col-md-12 mb-3">
                <div class="overview-wrap">
                    <h2 class="title-1">Edit Product</h2>
                </div>
            </div>
            <div class="container-fluid au-card mb-2">
                <form action="{{ route('admin.dashboard.product.update', $product->id) }}" enctype="multipart/form-data"
                    method="post">
                    @csrf @method('PUT')

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Product Name<span
                                        class="required"></span></label>
                                <input id="cc-payment" name="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" required
                                    placeholder="Enter Name" value="{{ old('name') ?? $product->name }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="basic_unit" class="control-label mb-1">Basic Unit</label>
                                <input id="basic_unit" name="basic_unit" type="text"
                                    class="form-control @error('basic_unit') is-invalid @enderror" placeholder="E.g KG"
                                    value="{{ old('basic_unit') ?? $product->basic_unit }}" value="{{ old('basic_unit') }}">

                                @error('basic_unit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="cover_image" class="control-label mb-1">Select Cover Image<span
                                        class="required"></span></label>
                                <input id="cover_image" name="cover_image" type="file"
                                    class="form-control @error('cover_image') is-invalid @enderror"
                                    value="{{ old('cover_image') ?? $product->cover_image }}">

                                @error('cover_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Price<span
                                        class="required"></span></label>
                                <input id="cc-payment" name="amount" type="text"
                                    class="form-control @error('amount') is-invalid @enderror" required
                                    value="{{ old('amount') ?? $product->amount }}" placeholder="Enter Amount">
                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Discount Price</label>
                                <input id="cc-payment" name="discount_price" type="text"
                                    class="form-control @error('discount_price') is-invalid @enderror"
                                    value="{{ old('discount_price') ?? $product->discount_price }}"
                                    placeholder="Enter Price">
                                @error('discount_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Description</label>
                                <textarea name="description" id="editor" class="form-control" cols="10" rows="5">{{ old('description') }}{{ $product->description }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <hr>
                        <div class="col-12">
                            <h4>Essential Details</h4>
                        </div>
                        <hr>

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="currency" class="control-label mb-1">Choose Currency<span
                                        class="required"></span></label>
                                <select id="currency" name="currency_id"
                                    class="form-control  @error('currency_id') is-invalid @enderror" required>
                                    <option value="">Select Currency</option>
                                    @foreach ($currencies as $currency)
                                        <option value="{{ $currency->id }}"
                                            {{ old('currency_id', $product->currency_id) == $currency->id ? 'selected' : '' }}>
                                            {{ $currency->name }}</option>
                                    @endforeach
                                </select>
                                @error('currency_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="brand" class="control-label mb-1">Brand<span
                                        class="required"></span></label>
                                <select id="brand" name="brand_id"
                                    class="form-control  @error('brand_id') is-invalid @enderror" required>
                                    <option value="">Select Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="store" class="control-label mb-1">Choose Store</label>
                                <select id="store" name="store_id"
                                    class="form-control  @error('store_id') is-invalid @enderror">
                                    <option value="">Select Store</option>
                                    @foreach ($stores as $store)
                                        <option value="{{ $store->id }}"
                                            {{ old('store_id', $product->store_id) == $store->id ? 'selected' : '' }}>
                                            {{ $store->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('store_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="category" class="control-label mb-1">Choose Category<span
                                        class="required"></span></label>
                                <select id="category" name="category_id"
                                    class="form-control @error('category_id') is-invalid @enderror" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Status<span
                                        class="required"></span></label>
                                <select id="status" name="status"
                                    class="form-control  @error('status') is-invalid @enderror" required>
                                    <option value="">Select Status</option>
                                    @foreach ($statusOptions as $status)
                                        <option
                                            value="{{ $status }}" {{ old('status', $product->status) == $status ? 'selected' : '' }}>
                                            {{ $status }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Stock Status<span
                                        class="required"></span></label>
                                <select id="stock_ststus" name="stock_status"
                                    class="form-control  @error('status') is-invalid @enderror" required>
                                    <option value="">Select Stock Status</option>
                                    @foreach ($stockOptions as $stock)
                                        <option value="{{ $stock }}" {{ old('stock_status', $product->stock_status) ? 'selected' : '' }}>
                                            {{ $stock }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <hr>
                        <div class="col-12">
                            <h4> SEO Optimization</h4>
                        </div>
                        <hr>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Meta Description</label>
                                <textarea id="cc-payment" rows="2" name="meta_description" type="text"
                                    class="form-control  @error('meta_description') is-invalid @enderror" placeholder="summarize your product">{{ $product->meta_description }}</textarea>

                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Meta Keyword</label>
                                <input name="meta_keyword" id="meta_keyword" value="{{ $product->meta_keyword }}"
                                    type="text" class="form-control" multiple>
                                @error('meta_keyword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                $('#meta_keyword').on('change', function() {
                                    var keywords = $(this).val().split(' ');
                                    var updatedKeywords = keywords.filter(function(keyword) {
                                        return keyword.trim() !== '';
                                    });
                                    $(this).val(updatedKeywords.join(' '));
                                });
                            });
                        </script>


                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <script>
            function submitForm() {
                document.getElementById('product-form').submit()

            }
        </script>

    </div>
    <!-- END MAIN CONTENT-->
@endsection
