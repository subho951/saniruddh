@include('front.elements.page-banner', [
    'pageTitle' => 'Login / Register',
    'breadcrumbs' => [['label' => 'Account Access']],
])

<style>
    .storefront-password-wrap {
        position: relative;
    }
    .storefront-password-wrap input {
        padding-right: 48px !important;
    }
    .storefront-password-toggle {
        align-items: center;
        background: transparent;
        border: 0;
        color: #7b5b34;
        cursor: pointer;
        display: flex;
        height: 100%;
        justify-content: center;
        position: absolute;
        right: 0;
        top: 0;
        width: 48px;
    }
    .storefront-password-toggle:focus {
        outline: 2px solid #c5a466;
        outline-offset: -4px;
    }
</style>

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
                        <div class="single-form">
                            <label for="signin_password">Password *</label>
                            <div class="storefront-password-wrap">
                                <input type="password" name="signin_password" id="signin_password" autocomplete="current-password" required>
                                <button type="button" class="storefront-password-toggle" data-password-toggle data-password-target="signin_password" aria-label="Show password" aria-pressed="false"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </div>
                        </div>
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
                        <div class="single-form">
                            <label for="signup_password">Password *</label>
                            <div class="storefront-password-wrap">
                                <input type="password" name="password" id="signup_password" autocomplete="new-password" required>
                                <button type="button" class="storefront-password-toggle" data-password-toggle data-password-target="signup_password" aria-label="Show password" aria-pressed="false"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <div class="single-form">
                            <label for="signup_confirm_password">Confirm Password *</label>
                            <div class="storefront-password-wrap">
                                <input type="password" name="confirm_password" id="signup_confirm_password" autocomplete="new-password" required>
                                <button type="button" class="storefront-password-toggle" data-password-toggle data-password-target="signup_confirm_password" aria-label="Show password" aria-pressed="false"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <div class="single-form"><button class="btn btn-primary btn-hover-dark rounded-pill" type="submit">Register</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('[data-password-toggle]').forEach(function (toggle) {
        toggle.addEventListener('click', function () {
            var input = document.getElementById(toggle.getAttribute('data-password-target'));
            var icon = toggle.querySelector('i');
            var showPassword = input.type === 'password';

            input.type = showPassword ? 'text' : 'password';
            toggle.setAttribute('aria-label', showPassword ? 'Hide password' : 'Show password');
            toggle.setAttribute('aria-pressed', showPassword ? 'true' : 'false');
            icon.classList.toggle('fa-eye', !showPassword);
            icon.classList.toggle('fa-eye-slash', showPassword);
        });
    });
</script>
