@php
    $cardProductId = data_get($cardProduct, 'id');
    $cardProductSlug = data_get($cardProduct, 'slug');
    $cardProductName = data_get($cardProduct, 'name');
    $cardProductImage = data_get($cardProduct, 'cover_image');
    $cardProductBasePrice = (float) data_get($cardProduct, 'base_price', 0);
    $cardProductPrice = (float) data_get($cardProduct, 'discounted_price', $cardProductBasePrice);
    $cardProductUrl = url('product/'.$cardProductSlug.'/'.\App\Helpers\Helper::encoded($cardProductId));
@endphp

<div class="single-product storefront-product-card">
    <div class="product-image">
        <a href="{{ $cardProductUrl }}">
            <img src="{{ $cardProductImage ? asset('public/uploads/product/'.$cardProductImage) : asset('public/uploads/no-image.jpg') }}" alt="{{ $cardProductName }}">
        </a>
        <span class="product-label {{ ($cardLabel ?? 'New') == 'Popular' ? 'sold-out' : 'hot' }}">{{ $cardLabel ?? 'New' }}</span>
    </div>
    <div class="product-content">
        <div class="product-category-action">
            <div class="product-category">
                <a href="{{ $cardCategoryUrl ?? 'javascript:;' }}">{{ $cardCategoryName ?? 'Saniruddh' }}</a>
            </div>
            <div class="product-action">
                <a href="{{ $cardProductUrl }}" class="action" data-tooltip="tooltip" data-placement="top" title="Choose Options"><i class="fa fa-shopping-cart"></i></a>
                <a href="{{ $user ? url('make-wishlist/'.\App\Helpers\Helper::encoded($cardProductId)) : url('signin') }}" class="action" data-tooltip="tooltip" data-placement="top" title="Wishlist"><i class="fa fa-heart-o"></i></a>
            </div>
        </div>
        <h3 class="product-title"><a href="{{ $cardProductUrl }}">{{ $cardProductName }}</a></h3>
        <div class="product-price">
            @if($cardProductBasePrice > $cardProductPrice)
                <span class="old-price"><i class="fa fa-inr"></i>{{ number_format($cardProductBasePrice, 2) }}</span>
            @endif
            <span class="sale-price"><i class="fa fa-inr"></i>{{ number_format($cardProductPrice, 2) }}</span>
        </div>
    </div>
</div>
