@include('front.elements.user-page-title', ['userPageTitle' => 'Dashboard', 'userPageCopy' => 'A quick view of your Saniruddh account.'])

<div class="storefront-dashboard-grid">
    <a href="{{ url('user/order-list') }}"><strong>{{ $order_count }}</strong><span>Orders</span></a>
    <a href="{{ url('user/wishlist') }}"><strong>{{ $wishlist_count }}</strong><span>Wishlist Items</span></a>
    <a href="{{ url('user/addresses') }}"><strong><i class="fa fa-map-marker"></i></strong><span>Saved Addresses</span></a>
</div>

<div class="storefront-user-section">
    <h2>Recent Orders</h2>
    @include('front.elements.user-order-table', [
        'orders' => $orderList,
        'orderStatusLabels' => [1 => 'Placed', 2 => 'Confirmed', 3 => 'Shipped', 4 => 'Delivered', 5 => 'Cancelled', 6 => 'Completed', 7 => 'Cancellation Requested'],
    ])
</div>
