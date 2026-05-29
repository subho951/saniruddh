<section class="auth-shell">
  <aside class="auth-brand-panel">
    <div>
      <div class="auth-logo-wrap">
        <a href="<?=url('admin')?>" class="auth-logo">
          <img src="<?=env('UPLOADS_URL').$generalSetting->site_logo?>" alt="<?=$generalSetting->site_name?>">
        </a>
      </div>
      <h1>Verify the code sent to your email.</h1>
      <p>Enter the four digit OTP to confirm your identity and continue to password reset.</p>
    </div>
    <div class="auth-brand-meta">
      <span><i class="fa-solid fa-lock"></i> OTP protected reset</span>
      <span><i class="fa-solid fa-clock"></i> Quick verification step</span>
    </div>
  </aside>
  <div class="auth-form-panel">
    <div class="auth-card">
      <span class="auth-kicker">OTP Verification</span>
      <h2>Enter your OTP</h2>
      <p class="auth-copy">Use the code sent to your registered admin email address.</p>

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

      <form id="otpForm" method="POST" action="" class="row g-3">
        @csrf
        <div class="col-12">
          <div class="otp-grid">
            <input type="text" name="otp1" class="form-control otpInput otp-input" id="otp1" maxlength="1" inputmode="numeric" required>
            <input type="text" name="otp2" class="form-control otpInput otp-input" id="otp2" maxlength="1" inputmode="numeric" required>
            <input type="text" name="otp3" class="form-control otpInput otp-input" id="otp3" maxlength="1" inputmode="numeric" required>
            <input type="text" name="otp4" class="form-control otpInput otp-input" id="otp4" maxlength="1" inputmode="numeric" required>
          </div>
        </div>
        <div class="col-12">
          <button class="btn btn-primary auth-btn w-100" type="submit">Verify OTP</button>
        </div>
      </form>
      <p class="auth-link-row">Wrong email? <a href="{{ url('/admin/forgot-password') }}">Start again</a></p>
      <div class="credits">
        Designed & Developed by <a target="_blank" href="https://www.projukti.info/">Projukti</a>
      </div>
    </div>
  </div>
</section>
<script>
  const otpInputs = document.querySelectorAll(".otpInput");
  otpInputs.forEach((input, index) => {
      input.addEventListener("input", function() {
          this.value = this.value.replace(/[^0-9]/g, "");
          if (this.value.length >= 1 && index < otpInputs.length - 1) {
              otpInputs[index + 1].focus();
          }
      });
      input.addEventListener("keydown", function(event) {
          if (event.key === "Backspace" && this.value.length === 0 && index > 0) {
              otpInputs[index - 1].focus();
          }
      });
  });
</script>
