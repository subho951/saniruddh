@include('front.elements.page-banner', [
    'pageTitle' => 'Featured Products',
    'breadcrumbs' => [['label' => 'Featured Products']],
])

<div class="section storefront-catalog-section">
    <div class="container">
        <div class="storefront-catalog-toolbar">
            <p>{{ $products->total() }} featured products found</p>
        </div>

        @if($products->isNotEmpty())
            <div class="row">
                @foreach($products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        @include('front.elements.product-card', [
                            'cardProduct' => $product,
                            'cardCategoryName' => 'Featured Collection',
                            'cardCategoryUrl' => url('specials'),
                            'cardLabel' => 'Popular',
                        ])
                    </div>
                @endforeach
            </div>
            @if($products->hasPages())
                <div class="page-pagination mt-5">{{ $products->links('pagination::bootstrap-4') }}</div>
            @endif
        @else
            <div class="storefront-empty-state">
                <h2>Featured collection coming soon</h2>
                <p>Explore the full boutique while new highlighted pieces are selected.</p>
                <a href="{{ url('/') }}" class="btn btn-primary btn-hover-dark rounded-pill">Browse Products</a>
            </div>
        @endif
    </div>
</div>
