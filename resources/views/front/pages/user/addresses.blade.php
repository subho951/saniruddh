@include('front.elements.user-page-title', ['userPageTitle' => 'Saved Addresses', 'userPageCopy' => 'Store billing and shipping addresses for faster checkout.'])

<div class="row">
    <div class="col-md-6">
        <div class="storefront-user-section">
            <h2>Billing Addresses</h2>
            @forelse($getBillingAddrs as $address)
                <div class="storefront-address-card"><h4>{{ $address->title }}</h4><p>{{ $address->address }}<br>{{ $address->city }}, {{ $address->state }} {{ $address->zipcode }}<br>{{ $address->country }}</p><a href="{{ url('user/addresses-delete/'.\App\Helpers\Helper::encoded($address->id)) }}">Delete</a></div>
            @empty
                <p>No billing address saved.</p>
            @endforelse
        </div>
    </div>
    <div class="col-md-6">
        <div class="storefront-user-section">
            <h2>Shipping Addresses</h2>
            @forelse($getShippingAddrs as $address)
                <div class="storefront-address-card"><h4>{{ $address->title }}</h4><p>{{ $address->address }}<br>{{ $address->city }}, {{ $address->state }} {{ $address->zipcode }}<br>{{ $address->country }}</p><a href="{{ url('user/addresses-delete/'.\App\Helpers\Helper::encoded($address->id)) }}">Delete</a></div>
            @empty
                <p>No shipping address saved.</p>
            @endforelse
        </div>
    </div>
</div>

@include('front.elements.address-form', ['addressFormAction' => request()->url()])
