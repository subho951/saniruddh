@include('front.elements.page-banner', [
    'pageTitle' => 'Order Not Completed',
    'breadcrumbs' => [['label' => 'Order Status']],
])

<div class="section storefront-status-section">
    <div class="container">
        <div class="storefront-status-card storefront-status-error">
            <i class="fa fa-times-circle"></i>
            <h2>We could not complete this order</h2>
            <p>Please return to your cart and try again.</p>
            <a href="{{ url('cart') }}" class="btn btn-primary btn-hover-dark rounded-pill">Return To Cart</a>
        </div>
    </div>
</div>
