<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>SMBQGM</title>
  <meta name="theme-color" content="#ffffff">

  <!-- Vendor Styles -->
  <link rel="stylesheet" media="screen" href="<?= base_url ('public/login') ?>/vendor/boxicons/css/boxicons.min.css" />

  <!-- Main Theme Styles + Bootstrap -->
  <link rel="stylesheet" media="screen" href="<?= base_url ('custom_me_login_compile.css') ?>">

  <!-- Page loading styles -->
  <style>
    .page-loading {
      position: fixed;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 100%;
      -webkit-transition: all .4s .2s ease-in-out;
      transition: all .4s .2s ease-in-out;
      background-color: #fff;
      opacity: 0;
      visibility: hidden;
      z-index: 9999;
    }

    .dark-mode .page-loading {
      background-color: #0b0f19;
    }

    .page-loading.active {
      opacity: 1;
      visibility: visible;
    }

    .page-loading-inner {
      position: absolute;
      top: 50%;
      left: 0;
      width: 100%;
      text-align: center;
      -webkit-transform: translateY(-50%);
      transform: translateY(-50%);
      -webkit-transition: opacity .2s ease-in-out;
      transition: opacity .2s ease-in-out;
      opacity: 0;
    }

    .page-loading.active>.page-loading-inner {
      opacity: 1;
    }

    .page-loading-inner>span {
      display: block;
      font-size: 1rem;
      font-weight: normal;
      color: #9397ad;
    }

    .dark-mode .page-loading-inner>span {
      color: #fff;
      opacity: .6;
    }

    .page-spinner {
      display: inline-block;
      width: 2.75rem;
      height: 2.75rem;
      margin-bottom: .75rem;
      vertical-align: text-bottom;
      border: .15em solid #b4b7c9;
      border-right-color: transparent;
      border-radius: 50%;
      -webkit-animation: spinner .75s linear infinite;
      animation: spinner .75s linear infinite;
    }

    .dark-mode .page-spinner {
      border-color: rgba(255, 255, 255, .4);
      border-right-color: transparent;
    }

    @-webkit-keyframes spinner {
      100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }

    @keyframes spinner {
      100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }
  </style>

  <!-- Theme mode -->
  <script>
    let mode = window.localStorage.getItem('mode'),
      root = document.getElementsByTagName('html')[0];
    if (mode !== null && mode === 'dark') {
      root.classList.add('dark-mode');
    } else {
      root.classList.remove('dark-mode');
    }
  </script>

  <!-- Page loading scripts -->
  <script>
    (function () {
      window.onload = function () {
        const preloader = document.querySelector('.page-loading');
        preloader.classList.remove('active');
        setTimeout(function () {
          preloader.remove();
        }, 1000);
      };
    })();
  </script>
</head>


<!-- Body -->

<body>

  <!-- Page loading spinner -->
  <div class="page-loading active">
    <div class="page-loading-inner">
      <div class="page-spinner"></div><span>Loading...</span>
    </div>
  </div>


  <!-- Page wrapper for sticky footer -->
  <!-- Wraps everything except footer to push footer to the bottom of the page if there is little content -->
  <main class="page-wrapper">


    <!-- Page content -->
    <section class="position-relative h-100 pt-5 pb-4">

      <!-- Sign in form -->
      <div class="container d-flex flex-wrap justify-content-center justify-content-xl-start h-100 pt-5">
        <div class="w-100 align-self-end pt-0 pt-md-4 pb-4" style="max-width: 526px;">
        <img src="<?= base_url ('public/login') ?>/logo.png" width="35%">
          <h1 class="text-center text-xl-start">Sistem Manajemen Baitul Qiradh Gala Muamalah</h1>
          <p class="text-center text-xl-start pb-3 mb-3">Selamat Datang di Sistem Manajemen Baitul Qiradh Gala Muamalah
            (SMBQGM)</p>
          <form class="needs-validation mb-2" action="<?= base_url ('process_login') ?>" method="POST" enctype="multipart/form-data" novalidate>
            <div class="position-relative mb-4">
              <label for="email" class="form-label fs-base">Username</label>
              <input type="text" name="username" class="form-control form-control-lg" required>
              <div class="invalid-feedback position-absolute start-0 top-100">Masukan Username Yang Valid !</div>
            </div>
            <div class="mb-4">
              <label for="password" class="form-label fs-base">Password</label>
              <div class="password-toggle">
                <input type="password" name="password" class="form-control form-control-lg" required>
                <label class="password-toggle-btn" aria-label="Show/hide password">
                  <input class="password-toggle-check" type="checkbox">
                  <span class="password-toggle-indicator"></span>
                </label>
                <div class="invalid-feedback position-absolute start-0 top-100">Masukan Password Yang Valid !</div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary shadow-primary btn-lg w-100">Masuk</button>
          </form>
        </div>
        <div class="w-100 align-self-end">
          <p class="nav d-block fs-xs text-center text-xl-start pb-2 mb-0">
            &copy; Versi Stable. Developer by
            <a class="nav-link d-inline-block p-0" href="//github.com/ziaulkamal" target="_blank" rel="noopener">Ziaul
              Kamal</a>
          </p>
        </div>
      </div>

      <!-- Background -->
      <div
        class="position-absolute top-0 end-0 w-50 h-100 bg-position-center bg-repeat-0 bg-size-cover d-none d-xl-block"
        style="background-image: url('public/login/img/account/signin-bg.jpg');"></div>
    </section>
  </main>
  <?php
    if ($this->session->flashdata('out')) {?>
      <script>alert('<?= $this->session->flashdata('out') ?>');</script>
    <?php }
    $this->session->sess_destroy();
  ?>
  <script src="<?= base_url ('public/login') ?>/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url ('public/login') ?>/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

  <!-- Main Theme Script -->
  <script src="<?= base_url ('public/login') ?>/js/theme.min.js"></script>
</body>

</html>