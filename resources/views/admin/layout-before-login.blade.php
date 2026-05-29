<!DOCTYPE html>
<html lang="en">
<head>
    <?=$head?>
    <style>
      :root {
        --auth-ink: #15110a;
        --auth-black: #050403;
        --auth-brown: #4b3205;
        --auth-brown-dark: #2c1d04;
        --auth-gold: #c5a466;
        --auth-soft: #f7f1e7;
        --auth-border: #deccaa;
        --auth-muted: #756a58;
      }
      body {
        background: #ffffff;
        color: var(--auth-ink);
        min-height: 100vh;
      }
      .auth-page {
        background:
          linear-gradient(90deg, #ffffff 0%, #ffffff 58%, #faf5eb 58%, #faf5eb 100%);
        min-height: 100vh;
        padding: 28px;
      }
      .auth-shell {
        display: grid;
        grid-template-columns: minmax(320px, .85fr) minmax(360px, 1fr);
        margin: 0 auto;
        max-width: 1120px;
        min-height: calc(100vh - 56px);
      }
      .auth-brand-panel {
        background: var(--auth-black);
        border: 1px solid var(--auth-brown-dark);
        border-radius: 10px 0 0 10px;
        color: #fff;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow: hidden;
        padding: 34px;
        position: relative;
      }
      .auth-brand-panel:before {
        background: #4b3205;
        content: "";
        height: 9px;
        left: 34px;
        position: absolute;
        right: 34px;
        top: 34px;
      }
      .auth-logo-wrap {
        margin-top: 34px;
      }
      .auth-logo {
        align-items: center;
        background: #ffffff;
        border: 1px solid var(--auth-gold);
        border-radius: 8px;
        display: inline-flex;
        min-height: 82px;
        padding: 10px 14px;
      }
      .auth-logo img {
        max-height: 62px;
        max-width: 210px;
        object-fit: contain;
      }
      .auth-brand-panel h1 {
        color: #fff7e8;
        font-size: 34px;
        font-weight: 800;
        line-height: 1.08;
        margin: 34px 0 12px;
      }
      .auth-brand-panel p {
        color: #d8d0c4;
        font-size: 15px;
        line-height: 1.7;
        margin: 0;
        max-width: 360px;
      }
      .auth-brand-meta {
        border-top: 1px solid rgba(197, 164, 102, .35);
        color: #cfc5b5;
        display: grid;
        gap: 10px;
        margin-top: 34px;
        padding-top: 18px;
      }
      .auth-brand-meta span {
        align-items: center;
        display: inline-flex;
        font-size: 13px;
        gap: 9px;
      }
      .auth-form-panel {
        align-items: center;
        background: #ffffff;
        border: 1px solid var(--auth-border);
        border-left: 0;
        border-radius: 0 10px 10px 0;
        display: flex;
        justify-content: center;
        padding: 42px;
      }
      .auth-card {
        max-width: 440px;
        width: 100%;
      }
      .auth-kicker {
        color: var(--auth-brown);
        display: block;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 0;
        margin-bottom: 8px;
        text-transform: uppercase;
      }
      .auth-card h2 {
        color: var(--auth-ink);
        font-size: 30px;
        font-weight: 800;
        line-height: 1.15;
        margin: 0 0 10px;
      }
      .auth-card .auth-copy {
        color: var(--auth-muted);
        line-height: 1.6;
        margin: 0 0 24px;
      }
      .auth-card .form-label {
        color: var(--auth-ink);
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 7px;
      }
      .auth-card .input-group {
        border: 1px solid var(--auth-border);
        border-radius: 8px;
        overflow: hidden;
      }
      .auth-card .input-group-text {
        background: var(--auth-soft);
        border: 0;
        color: var(--auth-brown);
        min-width: 46px;
        justify-content: center;
      }
      .auth-card .form-control {
        border: 0;
        color: var(--auth-ink);
        min-height: 48px;
      }
      .auth-card .form-control:focus {
        box-shadow: none;
      }
      .auth-card .input-group:focus-within,
      .auth-card .otp-input:focus {
        border-color: var(--auth-gold);
        box-shadow: 0 0 0 .2rem rgba(197, 164, 102, .2);
      }
      .auth-card .btn-primary,
      .auth-card .auth-btn {
        background: var(--auth-brown);
        border: 1px solid var(--auth-brown);
        border-radius: 8px;
        color: #fff7e8;
        font-weight: 800;
        min-height: 48px;
      }
      .auth-card .btn-primary:hover,
      .auth-card .auth-btn:hover {
        background: var(--auth-brown-dark);
        border-color: var(--auth-brown-dark);
      }
      .auth-link-row {
        color: var(--auth-muted);
        font-size: 14px;
        margin: 15px 0 0;
        text-align: center;
      }
      .auth-link-row a,
      .credits a {
        color: var(--auth-brown);
        font-weight: 800;
      }
      .auth-alert {
        border-radius: 8px;
        font-weight: 700;
      }
      .auth-alert.alert-success {
        background: #f3ead9;
        border-color: var(--auth-border);
        color: var(--auth-brown);
      }
      .auth-alert.alert-danger {
        background: #fbebea;
        border-color: #efc9c6;
        color: #8B2525;
      }
      .otp-grid {
        display: grid;
        gap: 12px;
        grid-template-columns: repeat(4, minmax(0, 1fr));
      }
      .auth-card .otp-input {
        border: 1px solid var(--auth-border);
        border-radius: 8px;
        font-size: 24px;
        font-weight: 800;
        height: 62px;
        text-align: center;
      }
      .credits {
        color: var(--auth-muted);
        font-size: 12px;
        margin-top: 20px;
        text-align: center;
      }
      @media (max-width: 991px) {
        .auth-page {
          background: #ffffff;
          padding: 18px;
        }
        .auth-shell {
          grid-template-columns: 1fr;
          min-height: auto;
        }
        .auth-brand-panel {
          border-radius: 10px 10px 0 0;
          min-height: 320px;
        }
        .auth-form-panel {
          border-left: 1px solid var(--auth-border);
          border-radius: 0 0 10px 10px;
          padding: 28px;
        }
      }
      @media (max-width: 575px) {
        .auth-page {
          padding: 10px;
        }
        .auth-brand-panel,
        .auth-form-panel {
          padding: 22px;
        }
        .auth-brand-panel h1,
        .auth-card h2 {
          font-size: 25px;
        }
        .otp-grid {
          gap: 8px;
        }
      }
    </style>
</head>
<body>
  <!-- <main style="background: url(<?=env('ADMIN_ASSETS_URL').'/assets/img/cover-image.jpg'?>) no-repeat;background-size: 100%;"> -->
  <main class="auth-page">
    <?=$maincontent?>
  </main><!-- End #main -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Vendor JS Files -->
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/vendor/chart.js/chart.umd.js"></script>
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/vendor/echarts/echarts.min.js"></script>
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/vendor/quill/quill.min.js"></script>
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/vendor/php-email-form/validate.js"></script>
  <!-- Template Main JS File -->
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/js/main.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script type="text/javascript">
    $(function(){
      $('.autohide').delay(5000).fadeOut('slow');
    })
  </script>
</body>
</html>
