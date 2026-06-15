@php
    $summaryItems = $summaryItems ?? collect();
    $summaryProducts = $summaryProducts ?? collect();
    $summaryTotals = $summaryTotals ?? [
        'subtotal' => $summaryItems->sum('subtotal'),
        'discount' => $summaryItems->sum('disc_amount'),
        'amount_after_discount' => $summaryItems->sum('amount_after_disc'),
        'shipping' => $summaryItems->sum('shipping_amt'),
        'tax' => $summaryItems->sum('tax_amt'),
        'net' => $summaryItems->sum('net_amt'),
    ];
@endphp

<div class="checkout-order">
    <div class="checkout-title"><h4 class="title">{{ $summaryTitle ?? 'Your Order' }}</h4></div>
    <div class="checkout-order-table table-responsive">
        <table class="table">
            <thead>
                <tr><th class="Product-name">Product</th><th class="Product-price">Total</th></tr>
            </thead>
            <tbody>
                @foreach($summaryItems as $summaryItem)
                    @php($summaryProduct = $summaryProducts->get($summaryItem->product_id))
                    <tr>
                        <td class="Product-name">
                            <p>{{ $summaryProduct->name ?? 'Product' }} x {{ $summaryItem->qty }}</p>
                            @if($summaryProduct && $summaryProduct->color)<small>Color: {{ $summaryProduct->color }}</small>@endif
                            @if($summaryItem->variation_name)<small>Size: {{ $summaryItem->variation_name }}</small>@endif
                        </td>
                        <td class="Product-price"><p><i class="fa fa-inr"></i> {{ number_format($summaryItem->subtotal, 2) }}</p></td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr><td class="Product-name"><p>Subtotal</p></td><td class="Product-price"><p><i class="fa fa-inr"></i> {{ number_format($summaryTotals['subtotal'], 2) }}</p></td></tr>
                @if($summaryTotals['discount'] > 0)
                    <tr><td class="Product-name"><p>Discount</p></td><td class="Product-price"><p>- <i class="fa fa-inr"></i> {{ number_format($summaryTotals['discount'], 2) }}</p></td></tr>
                @endif
                <tr><td class="Product-name"><p>Shipping</p></td><td class="Product-price"><p><i class="fa fa-inr"></i> {{ number_format($summaryTotals['shipping'], 2) }}</p></td></tr>
                <tr><td class="Product-name"><p>Tax</p></td><td class="Product-price"><p><i class="fa fa-inr"></i> {{ number_format($summaryTotals['tax'], 2) }}</p></td></tr>
                <tr><td class="Product-name"><p>Total</p></td><td class="total-price"><p><i class="fa fa-inr"></i> {{ number_format($summaryTotals['net'], 2) }}</p></td></tr>
            </tfoot>
        </table>
    </div>
    @if(!empty($showCodPayment))
        <div class="checkout-payment">
            <ul>
                <li>
                    <div class="single-payment">
                        <div class="payment-radio radio">
                            <input type="radio" name="payment_method" value="COD" id="cash" checked>
                            <label for="cash"><span></span> Cash on Delivery</label>
                            <div class="payment-details"><p>Pay with cash upon delivery.</p></div>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="checkout-btn"><button class="btn btn-primary btn-hover-dark rounded-pill d-block w-100" type="submit">Place Order</button></div>
        </div>
    @endif
</div>
