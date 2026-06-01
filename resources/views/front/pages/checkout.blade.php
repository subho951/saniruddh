@php
    $canUseSavedAddresses = $user && $getBillingAddrs->isNotEmpty() && $getShippingAddrs->isNotEmpty();
    $defaultCheckoutType = old('checkout_type', $canUseSavedAddresses ? 'EXISTING' : 'GUEST');
@endphp

@include('front.elements.page-banner', [
    'pageTitle' => 'Pay Securely',
    'breadcrumbs' => [['label' => 'Checkout']],
    'compactBanner' => true,
])

<div class="section section-padding-02 mt-n6">
    <div class="container">
        @if(! $user)
            <div class="checkout-info">
                <p class="info-header"><i class="fa fa-exclamation-circle"></i> Returning customer? <a href="{{ url('signin/'.\App\Helpers\Helper::encoded('checkout')) }}">Sign in to use saved addresses</a></p>
            </div>
        @endif

        <div class="checkout-wrapper">
            <form action="{{ url('place-order') }}" method="post">
                @csrf
                <input type="hidden" name="mode" value="order">
                <input type="hidden" name="subtotal" value="{{ $cartTotals['subtotal'] }}">
                <input type="hidden" name="disc_amount" value="{{ $cartTotals['discount'] }}">
                <input type="hidden" name="amount_after_disc" value="{{ $cartTotals['amount_after_discount'] }}">
                <input type="hidden" name="shipping_amt" value="{{ $cartTotals['shipping'] }}">
                <input type="hidden" name="tax_amt" value="{{ $cartTotals['tax'] }}">
                <input type="hidden" name="net_amt" value="{{ $cartTotals['net'] }}">

                <div class="row">
                    <div class="col-lg-7">
                        <div class="checkout-form">
                            <div class="checkout-title"><h4 class="title">Delivery Details</h4></div>

                            @if($canUseSavedAddresses)
                                <div class="storefront-checkout-switch">
                                    <label><input type="radio" name="checkout_type" value="EXISTING" {{ $defaultCheckoutType == 'EXISTING' ? 'checked' : '' }}> Use saved addresses</label>
                                    <label><input type="radio" name="checkout_type" value="GUEST" {{ $defaultCheckoutType == 'GUEST' ? 'checked' : '' }}> Enter another address</label>
                                </div>
                                <div id="saved-addresses" class="{{ $defaultCheckoutType == 'EXISTING' ? '' : 'd-none' }}">
                                    <div class="single-form">
                                        <label class="form-label">Billing address</label>
                                        <select name="billing" class="form-select">
                                            @foreach($getBillingAddrs as $address)
                                                <option value="{{ $address->id }}">{{ $address->title }}: {{ $address->address }}, {{ $address->city }}, {{ $address->state }} {{ $address->zipcode }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="single-form">
                                        <label class="form-label">Shipping address</label>
                                        <select name="shipping" class="form-select">
                                            @foreach($getShippingAddrs as $address)
                                                <option value="{{ $address->id }}">{{ $address->title }}: {{ $address->address }}, {{ $address->city }}, {{ $address->state }} {{ $address->zipcode }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <p><a href="{{ url('user/addresses/'.\App\Helpers\Helper::encoded('checkout')) }}">Manage saved addresses</a></p>
                                </div>
                            @else
                                <input type="hidden" name="checkout_type" value="GUEST">
                            @endif

                            <div id="guest-addresses" class="{{ $defaultCheckoutType == 'EXISTING' ? 'd-none' : '' }}">
                                @include('front.elements.checkout-address-fields', ['prefix' => 'b', 'heading' => 'Billing Details'])
                                @include('front.elements.checkout-address-fields', ['prefix' => 's', 'heading' => 'Shipping Details'])
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        @include('front.elements.order-summary', [
                            'summaryItems' => $cartItems,
                            'summaryProducts' => $cartProducts,
                            'summaryTotals' => $cartTotals,
                            'showCodPayment' => true,
                        ])
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    function syncCheckoutAddressMode(isExisting) {
        var savedAddresses = document.getElementById('saved-addresses');
        var guestAddresses = document.getElementById('guest-addresses');

        savedAddresses?.classList.toggle('d-none', !isExisting);
        guestAddresses?.classList.toggle('d-none', isExisting);
        savedAddresses?.querySelectorAll('input, select, textarea').forEach(function (field) {
            field.disabled = !isExisting;
        });
        guestAddresses?.querySelectorAll('input, select, textarea').forEach(function (field) {
            field.disabled = isExisting;
        });
    }

    document.querySelectorAll('input[name="checkout_type"]').forEach(function (radio) {
        radio.addEventListener('change', function () {
            syncCheckoutAddressMode(this.value === 'EXISTING');
        });
    });

    syncCheckoutAddressMode(document.querySelector('input[name="checkout_type"]:checked')?.value === 'EXISTING');
});
</script>
