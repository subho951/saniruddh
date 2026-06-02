@php
    $hasSavedBillingAddress = $user && $getBillingAddrs->isNotEmpty();
    $hasSavedShippingAddress = $user && $getShippingAddrs->isNotEmpty();
    $canUseSavedAddresses = $hasSavedBillingAddress && $hasSavedShippingAddress;
    $defaultCheckoutType = $canUseSavedAddresses && old('checkout_type', 'EXISTING') == 'EXISTING' ? 'EXISTING' : 'GUEST';
    $selectedBillingAddress = old('billing', data_get($getBillingAddrs->first(), 'id'));
    $selectedShippingAddress = old('shipping', data_get($getShippingAddrs->first(), 'id'));
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

                            @if($user)
                                <div class="storefront-checkout-switch">
                                    @if($canUseSavedAddresses)
                                        <label><input type="radio" name="checkout_type" value="EXISTING" {{ $defaultCheckoutType == 'EXISTING' ? 'checked' : '' }}> Use saved addresses</label>
                                    @endif
                                    <label><input type="radio" name="checkout_type" value="GUEST" {{ $defaultCheckoutType == 'GUEST' ? 'checked' : '' }}> Enter another address</label>
                                </div>

                                <div id="saved-addresses" class="storefront-form-card">
                                    <h3>Saved Billing Address</h3>
                                    @if($hasSavedBillingAddress)
                                        <div class="storefront-check-list">
                                            @foreach($getBillingAddrs as $address)
                                                <label class="storefront-address-card">
                                                    <input type="radio" name="billing" value="{{ $address->id }}" {{ (string) $selectedBillingAddress === (string) $address->id ? 'checked' : '' }} required>
                                                    <span>
                                                        <strong>{{ $address->title }}</strong><br>
                                                        {{ $address->address }}, {{ $address->city }}, {{ $address->state }} {{ $address->zipcode }}, {{ $address->country }}
                                                    </span>
                                                </label>
                                            @endforeach
                                        </div>
                                    @else
                                        <p>No billing address is saved yet.</p>
                                    @endif

                                    <h3 class="mt-4">Saved Shipping Address</h3>
                                    @if($hasSavedShippingAddress)
                                        <div class="storefront-check-list">
                                            @foreach($getShippingAddrs as $address)
                                                <label class="storefront-address-card">
                                                    <input type="radio" name="shipping" value="{{ $address->id }}" {{ (string) $selectedShippingAddress === (string) $address->id ? 'checked' : '' }} required>
                                                    <span>
                                                        <strong>{{ $address->title }}</strong><br>
                                                        {{ $address->address }}, {{ $address->city }}, {{ $address->state }} {{ $address->zipcode }}, {{ $address->country }}
                                                    </span>
                                                </label>
                                            @endforeach
                                        </div>
                                    @else
                                        <p>No shipping address is saved yet.</p>
                                    @endif

                                    <p class="mt-3 mb-0"><a href="{{ url('user/addresses/'.\App\Helpers\Helper::encoded('checkout')) }}">Manage saved addresses</a></p>
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
