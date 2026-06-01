@include('front.elements.page-banner', [
    'pageTitle' => 'Login / Register',
    'breadcrumbs' => [['label' => 'Account Access']],
])

<div class="section storefront-auth-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="login-register-wrapper storefront-form-card">
                    <h2 class="title">Login to Your Account</h2>
                    <form action="{{ url('signin') }}" method="post">
                        @csrf
                        <input type="hidden" name="page_redirect" value="{{ $page_redirect }}">
                        <div class="single-form"><label>Email *</label><input type="email" name="signin_email" value="{{ old('signin_email') }}" required></div>
                        <div class="single-form"><label>Password *</label><input type="password" name="signin_password" required></div>
                        <div class="single-form"><button class="btn btn-primary btn-hover-dark rounded-pill" type="submit">Login</button></div>
                    </form>
                    <p><a href="{{ url('forgot-password') }}">Lost your password?</a></p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login-register-wrapper storefront-form-card">
                    <h2 class="title">Create an Account</h2>
                    <form action="{{ url('signup') }}" method="post">
                        @csrf
                        <div class="single-form"><label>First Name *</label><input type="text" name="first_name" value="{{ old('first_name') }}" required></div>
                        <div class="single-form"><label>Last Name *</label><input type="text" name="last_name" value="{{ old('last_name') }}" required></div>
                        <div class="single-form"><label>Email Address *</label><input type="email" name="email" value="{{ old('email') }}" required></div>
                        <div class="single-form"><label>Phone *</label><input type="text" name="phone" value="{{ old('phone') }}" required></div>
                        <div class="single-form"><label>Password *</label><input type="password" name="password" required></div>
                        <div class="single-form"><label>Confirm Password *</label><input type="password" name="confirm_password" required></div>
                        <div class="single-form"><button class="btn btn-primary btn-hover-dark rounded-pill" type="submit">Register</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
