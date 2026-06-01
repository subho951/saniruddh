@include('front.elements.user-page-title', ['userPageTitle' => 'Change Password', 'userPageCopy' => 'Use a strong password that you do not reuse elsewhere.'])

<div class="storefront-form-card">
    <form action="{{ url('user/change-password') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $getUser->id }}">
        <div class="single-form"><label>Current Password *</label><input type="password" name="old_password" required></div>
        <div class="single-form"><label>New Password *</label><input type="password" name="new_password" required></div>
        <div class="single-form"><label>Confirm New Password *</label><input type="password" name="confirm_password" required></div>
        <div class="single-form"><button class="btn btn-primary rounded-pill" type="submit">Change Password</button></div>
    </form>
</div>
