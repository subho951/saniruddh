<section class="auth-shell">
  <aside class="auth-brand-panel">
    <div>
      <div class="auth-logo-wrap">
        <a href="<?=url('admin')?>" class="auth-logo">
          <img src="<?=env('UPLOADS_URL').$generalSetting->site_logo?>" alt="<?=$generalSetting->site_name?>">
        </a>
      </div>
      <h1>Recover access with confidence.</h1>
      <p>We will send a one time password to your registered admin email so you can reset your password safely.</p>
    </div>
    <div class="auth-brand-meta">
      <span><i class="fa-solid fa-envelope-open-text"></i> Email based verification</span>
      <span><i class="fa-solid fa-key"></i> Secure password recovery</span>
    </div>
  </aside>
  <div class="auth-form-panel">
    <div class="auth-card">
      <span class="auth-kicker">Password Recovery</span>
      <h2>Reset your account</h2>
      <p class="auth-copy">Enter your admin email address. If it matches our records, we will send your OTP.</p>

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
          <button class="btn btn-primary auth-btn w-100" type="submit">Send OTP</button>
        </div>
      </form>
      <p class="auth-link-row">Remembered it? <a href="{{ url('/admin') }}">Back to sign in</a></p>
      <div class="credits">
        Designed & Developed by <a target="_blank" href="https://www.projukti.info/">Projukti</a>
      </div>
    </div>
  </div>
</section>
