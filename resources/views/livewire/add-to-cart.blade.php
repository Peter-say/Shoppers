<div>
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="{{ route('web.shop.index') }}">Home</a> <span
                        class="mx-2 mb-0">/</span>
                    <strong class="text-black">{{ $product->name }}</strong>
                </div>
            </div>

        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <form method="post">
                @csrf
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <img class="img-fluid " src="{{ asset($product->cover_image) }}" alt="Image placeholder"></a>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <h2 class="text-black">{{ $product->name }}</h2>
                        <p>{{ $product->description }}</p>
                        <p><strong class="text-primary h4">${{ $product->amount }}</strong></p>
                        <div class="mb-1 d-flex">
                            <label for="option-sm" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;">
                                    <input type="radio" id="option-sm" name="size" value="small "
                                        wire:model="size">
                                </span>
                                <span class="d-inline-block text-black">Small</span>
                            </label>
                            <label for="option-md" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;">
                                    <input type="radio" id="option-md" name="size" value="medium"
                                        wire:model="size">
                                </span>
                                <span class="d-inline-block text-black">Medium</span>
                            </label>
                            <label for="option-lg" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;">
                                    <input type="radio" id="option-lg" name="size" value="large"
                                        wire:model="size">
                                </span>
                                <span class="d-inline-block text-black">Large</span>
                            </label>
                            <label for="option-xl" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;">
                                    <input type="radio" id="option-xl" name="size" value="extra_large"
                                        wire:model="size">
                                </span>
                                <span class="d-inline-block text-black">Extra Large</span>
                            </label>
                            @error('size')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <div class="input-group mb-3" style="max-width: 120px;">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-primary js-btn-minus"
                                        wire:click="decrementQuantity()" type="button">&minus;</button>
                                </div>
                                <input type="text" name="quantity" class="form-control text-center" value="1"
                                    placeholder="Enter Quantity" aria-label="Example text with button addon"
                                    aria-describedby="button-addon1" wire:model="quantity">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary js-btn-plus" wire:click="incrementQuantity()"
                                        type="button">&plus;</button>
                                </div>
                                @error('quantity')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" value="{{ $product->price }}" name="price" wire:model="price">
                        <button wire:click.prevent="addToCart({{ $product->id }})"
                            class="buy-now btn btn-sm btn-primary" id="add-to-cart-button">Add to cart</button>
                        </p>


                    </div>
                </div>
            </form>
            @if (session()->has('success_message'))
                <div class="popup-message success" id="popup-message">
                    <p class="text-white">{{ session('success_message') }}</p>
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <a href="{{ route('web.shop.index') }}" class="btn btn-primary">Continue Shopping</a>
                </div>
            @endif

            @if (session()->has('success_message'))
                <div class="popup-message success" id="popup-message">
                    <p class="text-white">{{ session('success_message') }}</p>
                </div>
            @endif

        </div>
    </div>

    <div class="site-section block-3 site-blocks-2 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 site-section-heading text-center pt-4">
                    <h2>Featured Products</h2>
                </div>
            </div>
            <div class="row">

                <div class="col-md-12">
                    @foreach ($related_products as $related)
                        <div class=" nonloop-block-3 owl-carousel">
                            <div class="item">
                                <div class="block-4 text-center">
                                    <figure class="block-4-image">
                                        <img src="images/cloth_1.jpg" alt="Image placeholder" class="img-fluid">
                                    </figure>
                                    <div class="block-4-text p-4">
                                        <h3><a href="#">{{ $related->name }}</a></h3>
                                        <p class="mb-0">{{ Str::limit($related->description, 40) }}</p>
                                        <p class="text-primary font-weight-bold">${{ $related->amount }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>


</div>
