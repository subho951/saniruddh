<div class="storefront-account-nav">
    <h4>My Account</h4>
    <ul>
        <li><a class="{{ request()->is('user/dashboard') ? 'active' : '' }}" href="{{ url('user/dashboard') }}">Dashboard</a></li>
        <li><a class="{{ request()->is('user/account') ? 'active' : '' }}" href="{{ url('user/account') }}">Account Details</a></li>
        <li><a class="{{ request()->is('user/addresses*') ? 'active' : '' }}" href="{{ url('user/addresses') }}">Addresses</a></li>
        <li><a class="{{ request()->is('user/order-*') ? 'active' : '' }}" href="{{ url('user/order-list') }}">Orders</a></li>
        <li><a class="{{ request()->is('user/wishlist*') ? 'active' : '' }}" href="{{ url('user/wishlist') }}">Wishlist</a></li>
        <li><a class="{{ request()->is('user/change-password') ? 'active' : '' }}" href="{{ url('user/change-password') }}">Change Password</a></li>
        <li><a href="{{ url('user/signout') }}">Sign Out</a></li>
    </ul>
</div>
