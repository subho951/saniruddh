@php
    $productGallery = $product_images->pluck('image')->filter();
    if ($productGallery->isEmpty() && $product->cover_image) {
        $productGallery = collect([$product->cover_image]);
    }
    $wishlistUrl = $user ? url('make-wishlist/'.\App\Helpers\Helper::encoded($product->id)) : url('signin');
@endphp

@include('front.elements.page-banner', [
    'pageTitle' => $product->name,
    'breadcrumbs' => [
        ['label' => $productCategory->category_name ?? 'Products', 'url' => $productCategory ? url('products/'.$productCategory->slug) : url('/')],
        ['label' => $product->name],
    ],
])

<div class="section storefront-product-details-section">
    <div class="container">
        <div class="product-details-wrapper">
            <div class="row gx-md-10 align-items-xl-center">
                <div class="col-md-6">
                    <div class="product-details-images">
                        <div class="swiper-container gallery-top">
                            <div class="swiper-wrapper">
                                @foreach($productGallery as $galleryImage)
                                    <div class="swiper-slide"><img src="{{ asset('public/uploads/product/'.$galleryImage) }}" alt="{{ $product->name }}"></div>
                                @endforeach
                            </div>
                        </div>
                        <div class="swiper-container gallery-thumbs">
                            <div class="swiper-wrapper">
                                @foreach($productGallery as $galleryImage)
                                    <div class="swiper-slide"><img src="{{ asset('public/uploads/product/'.$galleryImage) }}" alt="{{ $product->name }}"></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product-details-content">
                        <div class="product-category">
                            <a href="{{ $productCategory ? url('products/'.$productCategory->slug) : 'javascript:;' }}">{{ $productSubcategory->category_name ?? 'Boutique Apparel' }}</a>
                        </div>
                        <h1 class="product-title">{{ $product->name }}</h1>
                        <div class="product-price-rating">
                            <div class="product-price">
                                @if($product->base_price > $product->discounted_price)
                                    <span class="old-price"><i class="fa fa-inr"></i> {{ number_format($product->base_price, 2) }}</span>
                                @endif
                                <span class="sale-price"><i class="fa fa-inr"></i> <span id="product-price">{{ number_format($product->discounted_price, 2) }}</span></span>
                            </div>
                        </div>
                        <p>{{ $product->short_description }}</p>

                        <form action="{{ url('add-to-cart') }}" method="post" id="add-to-cart-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="product_price" id="product-price-input" value="{{ $product->discounted_price }}">
                            <div class="product-info">
                                <div class="single-info">
                                    <span class="label">Availability:</span>
                                    <span class="value">{{ $product->product_qty > 0 ? 'In Stock' : 'Out of Stock' }}</span>
                                </div>
                                <div class="single-info">
                                    <span class="label">Product Code:</span>
                                    <span class="value">{{ $product->product_sku }}</span>
                                </div>
                                @foreach($variations as $variation)
                                    <div class="single-info storefront-variation">
                                        <label class="label" for="variation-{{ $variation['attr_id'] }}">{{ $variation['attr_name'] }}:</label>
                                        <select id="variation-{{ $variation['attr_id'] }}" name="variations[]" class="form-select product-variation-select" data-parent-attribute="{{ $variation['attr_id'] }}" required>
                                            <option value="">Choose {{ $variation['attr_name'] }}</option>
                                            @foreach($variation['attr_vals'] as $variationValue)
                                                <option value="{{ $variationValue['attr_val_id'] }}">{{ $variationValue['attr_val_name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endforeach
                                <div class="single-info">
                                    <span class="label">Quantity:</span>
                                    <div class="product-quantity d-inline-flex">
                                        <button type="button" class="sub">-</button>
                                        <input type="text" name="product_qty" value="1">
                                        <button type="button" class="add">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="product-cart-favourate">
                                <div class="product-cart">
                                    <button class="btn btn-info btn-hover-primary rounded-pill" type="submit" {{ $product->product_qty <= 0 ? 'disabled' : '' }}>Add to Cart</button>
                                </div>
                                <div class="product-favourate">
                                    <a href="{{ $wishlistUrl }}" class="favourate" title="Wishlist"><i class="fa fa-heart-o"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="product-details-tabs section-padding">
            <ul class="nav nav-justified">
                <li class="nav-item"><a class="active" data-bs-toggle="tab" href="#description">Description</a></li>
                <li class="nav-item"><a data-bs-toggle="tab" href="#information">Information</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="description">
                    <div class="product-description">{!! $product->long_description !!}</div>
                </div>
                <div class="tab-pane fade" id="information">
                    <div class="information">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="information-content">
                                    <h4 class="title">Product Information</h4>
                                    <ul>
                                        <li>SKU: {{ $product->product_sku }}</li>
                                        <li>Made by: {{ $product->who_made_it }}</li>
                                        <li>Shipping: {{ $product->shipping_info }}</li>
                                        <li>Cash on Delivery: Available</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="information-content">
                                    <h4 class="title">Policies</h4>
                                    <ul>
                                        <li>Secure checkout</li>
                                        <li>Order tracking after dispatch</li>
                                        <li>Contact us for assistance</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($similar_products))
            <div class="related-products section-padding mt-n2">
                <div class="section-title"><h2 class="title">Related Products</h2></div>
                <div class="product-active">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach($similar_products as $similarProduct)
                                <div class="swiper-slide">
                                    @include('front.elements.product-card', [
                                        'cardProduct' => $similarProduct,
                                        'cardCategoryName' => 'Related Product',
                                        'cardCategoryUrl' => 'javascript:;',
                                        'cardLabel' => 'Popular',
                                    ])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.product-variation-select').forEach(function (select) {
        select.addEventListener('change', function () {
            if (!this.value) {
                return;
            }

            fetch('{{ url('get-variation-price') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: '{{ $product->id }}',
                    parent_attr_id: this.dataset.parentAttribute,
                    attr_val_id: this.value
                })
            })
            .then(function (response) { return response.json(); })
            .then(function (payload) {
                var price = payload.data ? payload.data.discounted_price : payload.discounted_price;
                if (price) {
                    document.getElementById('product-price').textContent = price;
                    document.getElementById('product-price-input').value = price;
                }
            });
        });
    });
});
</script>
