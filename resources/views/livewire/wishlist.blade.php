<div>
    @if ($wishlist == null)
        <div class="d-flex justify-content-around">
            <h4>You have not added any items to wishlist yet</h4>
            <span>
                <a href="{{ route('web.shop.index') }}" class="btn btn-primary">Go shopping!</a>
            </span>
        </div>
    @else
        <div class="row mb-5">
            <form class="col-md-12">
                <div class="site-blocks-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-move">Move to cart</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wishlist as $wishlistItem)
                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="{{ asset($wishlistItem->product->cover_image) }}"
                                            data-lightbox="product-gallery">
                                            <img src="{{ asset('product/cover_images/'. $wishlistItem->product->cover_image) }}" alt="Image"
                                                class="img-fluid show-wishlist-image">
                                        </a>
                                    </td>
                                    <td class="product-name">
                                        <h2 class="h5 text-black">{{ $wishlistItem->product->name }}</h2>
                                    </td>
                                    <td>${{ $wishlistItem->product->amount }}</td>
                                    <td><button style=" cursor: pointer;" class="btn btn-primary fa fa-arrows-alt"
                                            wire:click="moveWishlistItemToCart({{ $wishlistItem->product_id }})">Move</button>
                                    </td>
                                    <td>
                                        <button type="button" wire:click="removeFromWishlist({{ $wishlistItem->id }})"
                                            class="btn btn-primary btn-sm">X</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div>

        <div class="row mt-5 ">
            <div class="col-md-6">
                <div class="row mb-5">

                    {{-- <div class="col-md-6 mb-3 mb-md-0">
                    <form wire:submit.prevent="updatewishlistItems">
                        <button type="button" wire:click="updatewishlistItems()"
                            class="btn btn-primary btn-sm btn-block">Update wishlist</button>
                    </form>
                </div> --}}

                    <div class="col-md-6">
                        <a href="{{ route('web.shop.index') }}"
                            class="btn btn-outline-primary btn-sm btn-block">Continue
                            Shopping</a>
                    </div>
                </div>

            </div>

        </div>
    @endif
   @include('notifications.pop-up')

    {{-- <script>
        Livewire.on('wishlistUpdated', () => {
            Livewire.emit('refreshComponent');
        })
    </script> --}}
</div>
