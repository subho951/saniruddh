@include('front.elements.page-banner', [
    'pageTitle' => 'Order Placed',
    'breadcrumbs' => [['label' => 'Order Confirmation']],
])

<div class="section storefront-status-section">
    <div class="container">
        <div class="storefront-status-card">
            <i class="fa fa-check-circle"></i>
            <h2>Thank you for your order</h2>
            <p>Your order <strong>{{ $getOrder->order_no }}</strong> has been placed successfully.</p>
            @if($getOrder->payment_mode == 'COD')
                <p>Please keep <strong><i class="fa fa-inr"></i> {{ number_format($getOrder->net_amt, 2) }}</strong> ready for cash payment on delivery.</p>
            @endif
            <div class="storefront-status-actions">
                <a href="{{ url('/') }}" class="btn btn-primary btn-hover-dark rounded-pill">Continue Shopping</a>
                @if($user)<a href="{{ url('user/order-details/'.\App\Helpers\Helper::encoded($getOrder->id)) }}" class="btn btn-outline-dark rounded-pill">View Order</a>@endif
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-lg-7">
                @include('front.elements.order-summary', [
                    'summaryItems' => $cartItems,
                    'summaryProducts' => $cartProducts,
                    'summaryTotals' => [
                        'subtotal' => $getOrder->subtotal,
                        'discount' => $getOrder->disc_amount,
                        'amount_after_discount' => $getOrder->amount_after_disc,
                        'shipping' => $getOrder->shipping_amt,
                        'tax' => $getOrder->tax_amt,
                        'net' => $getOrder->net_amt,
                    ],
                    'summaryTitle' => 'Order Summary',
                ])
            </div>
        </div>
    </div>
</div>
