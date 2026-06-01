@include('front.elements.user-page-title', ['userPageTitle' => 'Wishlist', 'userPageCopy' => 'Your saved boutique pieces.'])
<div class="row">
    @forelse($wishlistItems as $wishlistItem)
        @php($wishlistProduct = $wishlistProducts->get($wishlistItem->product_id))
        @if($wishlistProduct)
            <div class="col-md-4">
                @include('front.elements.product-card', ['cardProduct' => $wishlistProduct, 'cardLabel' => 'Saved', 'cardCategoryName' => 'Wishlist', 'cardCategoryUrl' => 'javascript:;'])
                <p><a href="{{ url('user/wishlist-product-delete/'.\App\Helpers\Helper::encoded($wishlistItem->id)) }}">Remove from wishlist</a></p>
            </div>
        @endif
    @empty
        <div class="storefront-empty-state"><h2>Your wishlist is empty</h2><a href="{{ url('/') }}" class="btn btn-primary rounded-pill">Browse Products</a></div>
    @endforelse
</div>
