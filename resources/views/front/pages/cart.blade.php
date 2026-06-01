@include('front.elements.page-banner', [
    'pageTitle' => 'My Shopping Cart',
    'breadcrumbs' => [['label' => 'Cart']],
    'compactBanner' => true,
])

<div class="section section-padding-02 mt-n1">
    <div class="container">
        @if($cartItems->isNotEmpty())
            <div class="cart-wrapper">
                <form action="{{ url('update-cart') }}" method="post">
                    @csrf
                    <div class="cart-table table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-image">Image</th>
                                    <th class="product-name">Product Name</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-price">Total Price</th>
                                    <th class="product-action">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $cartItem)
                                    @php($cartProduct = $cartProducts->get($cartItem->product_id))
                                    <tr>
                                        <td class="product-image"><img src="{{ $cartProduct && $cartProduct->cover_image ? asset('public/uploads/product/'.$cartProduct->cover_image) : asset('public/uploads/no-image.jpg') }}" alt="{{ $cartProduct->name ?? 'Product' }}"></td>
                                        <td class="product-name">
                                            <a class="name" href="{{ $cartProduct ? url('product/'.$cartProduct->slug.'/'.\App\Helpers\Helper::encoded($cartProduct->id)) : 'javascript:;' }}">{{ $cartProduct->name ?? 'Product' }}</a>
                                            @if($cartItem->variation_name)<small>{{ $cartItem->variation_name }}</small>@endif
                                        </td>
                                        <td class="product-quantity">
                                            <div class="product-quantity d-inline-flex">
                                                <button type="button" class="sub" aria-label="Decrease quantity">-</button>
                                                <input type="number" name="quantities[{{ $cartItem->id }}]" min="1" max="{{ $cartProduct->product_qty ?? 999 }}" value="{{ $cartItem->qty }}" aria-label="Quantity">
                                                <button type="button" class="add" aria-label="Increase quantity">+</button>
                                            </div>
                                        </td>
                                        <td class="product-price"><div class="product-price"><span class="sale-price"><i class="fa fa-inr"></i> {{ number_format($cartItem->subtotal, 2) }}</span></div></td>
                                        <td class="product-action"><a class="close" href="{{ url('cart-item-remove/'.\App\Helpers\Helper::encoded($cartItem->id)) }}"><span class="material-icons">clear</span></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="cart-btn">
                        <div class="cart-btn-left"><a href="{{ url('/') }}" class="btn btn-dark btn-hover-primary rounded-pill">Continue Shopping</a></div>
                        <div class="cart-btn-right">
                            <button type="submit" form="clear-cart-form" class="btn btn-outline-dark btn-hover-dark rounded-pill">Clear Cart</button>
                            <button type="submit" class="btn btn-outline-dark btn-hover-dark rounded-pill">Update Cart</button>
                        </div>
                    </div>
                </form>
                <form id="clear-cart-form" action="{{ url('clear-cart') }}" method="post">@csrf</form>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="cart-shipping">
                        <div class="cart-title"><h4 class="title">Shipping Country</h4></div>
                        <div class="storefront-shipping-country"><i class="fa fa-map-marker"></i><span>India</span></div>
                        <p class="storefront-shipping-note">Shipping is currently available within India only.</p>
                    </div>
                </div>
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <div class="cart-totals">
                        <div class="cart-title"><h4 class="title">Cart totals</h4></div>
                        <div class="cart-total-table">
                            <table class="table">
                                <tbody>
                                    <tr><td><p class="value">Subtotal</p></td><td><p class="price"><i class="fa fa-inr"></i> {{ number_format($cartTotals['subtotal'], 2) }}</p></td></tr>
                                    @if($cartTotals['discount'] > 0)<tr><td><p class="value">Discount</p></td><td><p class="price">- <i class="fa fa-inr"></i> {{ number_format($cartTotals['discount'], 2) }}</p></td></tr>@endif
                                    <tr><td><p class="value">Shipping</p></td><td><p class="price"><i class="fa fa-inr"></i> {{ number_format($cartTotals['shipping'], 2) }}</p></td></tr>
                                    <tr><td><p class="value">Tax</p></td><td><p class="price"><i class="fa fa-inr"></i> {{ number_format($cartTotals['tax'], 2) }}</p></td></tr>
                                    <tr><td><p class="value">Total</p></td><td><p class="price"><i class="fa fa-inr"></i> {{ number_format($cartTotals['net'], 2) }}</p></td></tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="cart-total-btn d-grid"><a href="{{ url('checkout') }}" class="btn btn-dark btn-hover-primary rounded-pill">Proceed To Checkout</a></div>
                    </div>
                </div>
            </div>
        @else
            <div class="storefront-empty-state">
                <h2>Your cart is empty</h2>
                <p>Browse the boutique collection and add something you love.</p>
                <a href="{{ url('/') }}" class="btn btn-primary btn-hover-dark rounded-pill">Continue Shopping</a>
            </div>
        @endif
    </div>
</div>
