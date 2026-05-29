<section class="auth-shell">
  <aside class="auth-brand-panel">
    <div>
      <div class="auth-logo-wrap">
        <a href="<?=url('admin')?>" class="auth-logo">
          <img src="<?=env('UPLOADS_URL').$generalSetting->site_logo?>" alt="<?=$generalSetting->site_name?>">
        </a>
      </div>
      <h1>Create a new secure password.</h1>
      <p>Choose a fresh password for your admin account and return to the sign in screen.</p>
    </div>
    <div class="auth-brand-meta">
      <span><i class="fa-solid fa-key"></i> Password reset final step</span>
      <span><i class="fa-solid fa-shield"></i> Keep your account protected</span>
    </div>
  </aside>
  <div class="auth-form-panel">
    <div class="auth-card">
      <span class="auth-kicker">Reset Password</span>
      <h2>Set new password</h2>
      <p class="auth-copy">Enter and confirm your new password to complete recovery.</p>

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
          <label for="new_password" class="form-label">New Password</label>
          <div class="input-group has-validation">
            <span class="input-group-text"><i class="fas fa-key"></i></span>
            <input type="password" name="new_password" class="form-control" id="new_password" autocomplete="new-password" required>
          </div>
        </div>
        <div class="col-12">
          <label for="old_password" class="form-label">Confirm Password</label>
          <div class="input-group has-validation">
            <span class="input-group-text"><i class="fas fa-key"></i></span>
            <input type="password" name="old_password" class="form-control" id="old_password" autocomplete="new-password" required>
          </div>
        </div>
        <div class="col-12">
          <button class="btn btn-primary auth-btn w-100" type="submit">Update Password</button>
        </div>
      </form>
      <p class="auth-link-row">Back to <a href="{{ url('/admin') }}">sign in</a></p>
      <div class="credits">
        Designed & Developed by <a target="_blank" href="https://www.projukti.info/">Projukti</a>
      </div>
    </div>
  </div>
</section>
