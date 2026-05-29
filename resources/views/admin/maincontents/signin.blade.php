<section class="auth-shell">
  <aside class="auth-brand-panel">
    <div>
      <div class="auth-logo-wrap">
        <a href="<?=url('admin')?>" class="auth-logo">
          <img src="<?=env('UPLOADS_URL').$generalSetting->site_logo?>" alt="<?=$generalSetting->site_name?>">
        </a>
      </div>
      <h1>Elegant control for a refined boutique.</h1>
      <p>Manage listings, orders, customers and storefront content from a focused Saniruddh admin workspace.</p>
    </div>
    <div class="auth-brand-meta">
      <span><i class="fa-solid fa-shield-halved"></i> Secure admin access</span>
      <span><i class="fa-solid fa-gem"></i> Premium boutique operations</span>
    </div>
  </aside>
  <div class="auth-form-panel">
    <div class="auth-card">
      <span class="auth-kicker">Admin Panel</span>
      <h2>Welcome back</h2>
      <p class="auth-copy">Enter your credentials to continue managing the Saniruddh storefront.</p>

      @if(session('success_message'))
        <div class="alert alert-success auth-alert alert-dismissible fade show autohide" role="alert">
          {{ session('success_message') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      @if(session('error_message'))
        <div class="alert alert-danger auth-alert alert-dismissible fade show autohide" role="alert">
          {{ session('error_message') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <form method="POST" action="" class="row g-3">
        @csrf
        <div class="col-12">
          <label for="email" class="form-label">Email Address</label>
          <div class="input-group has-validation">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            <input type="email" name="email" class="form-control" id="email" autocomplete="email" required>
          </div>
        </div>
        <div class="col-12">
          <label for="password" class="form-label">Password</label>
          <div class="input-group has-validation">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input type="password" name="password" class="form-control" id="password" autocomplete="current-password" required>
          </div>
        </div>
        <div class="col-12">
          <button class="btn btn-primary auth-btn w-100" type="submit">Sign In</button>
        </div>
      </form>
      <p class="auth-link-row">Forgot password? <a href="{{ url('/admin/forgot-password') }}">Reset access</a></p>
      <div class="credits">
        Designed & Developed by <a target="_blank" href="https://www.projukti.info/">Projukti</a>
      </div>
    </div>
  </div>
</section>
