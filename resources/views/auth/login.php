<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta20
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Sign in with illustration - Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>

    <link href="<?= asset_v('tabler/dist/css/tabler.min.css?1692870487')?>" rel="stylesheet"/>
    <link href="<?= asset_v('tabler/dist/css/tabler-flags.min.css?1692870487')?>" rel="stylesheet"/>
    <link href="<?= asset_v('tabler/dist/css/tabler-payments.min.css?1692870487')?>" rel="stylesheet"/>
    <link href="<?= asset_v('tabler/dist/css/tabler-vendors.min.css?1692870487')?>" rel="stylesheet"/>
    <link href="<?= asset_v('tabler/dist/css/demo.min.css?1692870487')?>" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body  class=" d-flex flex-column">
    <script src="<?= asset_v('tabler/dist/js/demo-theme.min.js?1692870487')?>"></script>
    <div class="page page-center">
      <div class="container container-normal py-4">
        <div class="row align-items-center g-4">
          <div class="col-lg">
            <div class="container-tight">
              <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark"><img src="<?= asset_v('tabler/dist/static/logo.svg')?>" height="36" alt=""></a>
              </div>
              <div class="card card-md">
                <div class="card-body">
                  <h2 class="h2 text-center mb-4">Login to your account</h2>
                  <form action="" method="post" id="formlogin" enctype="multipart/form-data">
                    <?= csrf()?>
                    <div class="mb-3">
                      <label class="form-label">Username</label>
                      <input type="text" name="username" id="username" class="form-control" placeholder="your username or nik" autocomplete="off">
                    </div>
                    <div class="mb-2">
                      <label class="form-label">
                        Password
                        <span class="form-label-description">
                          <a href="<?= asset_v('tabler/dist/forgot-password.html')?>">I forgot password</a>
                        </span>
                      </label>
                      <div class="input-group input-group-flat">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Your password"  autocomplete="off">
                        <span class="input-group-text">
                          <a href="#" class="link-secondary" id="showpassword" title="Show password" data-bs-toggle="tooltip">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                          </a>
                        </span>
                      </div>
                    </div>
                    <div class="mb-2">
                      <label class="form-check">
                        <input type="checkbox" class="form-check-input"/>
                        <span class="form-check-label">Remember me on this device</span>
                      </label>
                    </div>
                    <div class="form-footer">
                      <button type="submit" id="btnlogin" class="btn btn-primary w-100">Sign in</button>
                      <button class="btn btn-primary w-100" style="display: none;" id="loading" disabled>
                            <div class="spinner-border me-2" role="status"></div>
                            <strong>Loading...</strong>
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg d-none d-lg-block">
            <img src="<?= asset_v('tabler/static/illustrations/undraw_secure_login_pdn4.svg')?>" height="300" class="d-block mx-auto" alt="">
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= asset_v('tabler/dist/js/tabler.min.js?1692870487')?>" defer></script>
    <script src="<?= asset_v('tabler/dist/js/demo.min.js?1692870487')?>" defer></script>
    <script>
        document.getElementById('showpassword').addEventListener('click', function(e){
            e.preventDefault()
            var passwordInput = document.getElementById('password')
            if(passwordInput.type === 'password'){
                passwordInput.type = 'text'
            } else {
                passwordInput.type = 'password'
            }
        })
        $(document).ready(function(){
          $('#btnlogin').on('click', function(e){
            e.preventDefault();
            const btn = $(this)
            const loading = $('#loading')
            btn.hide()
            loading.show()
              var url = '<?= route('auth.login')?>';
              var formdata = new FormData($('#formlogin')[0]);
              $.ajax({
                  type: 'POST',
                  url: url,
                  data:formdata,
                  headers: {
                    'X-CSRF-TOKEN' : '<?= csrfHeader()?>'
                  },
                  processData:false,
                  contentType:false,
                  dataType: 'json',
                  success:function(response){
                      if (response.status === 200) {
                          btn.show()
                          loading.hide()
                          let timerInterval;
                          Swal.fire({
                              icon: 'success',
                              title: "Login Berhasil",
                              timer: 2000,
                              timerProgressBar: true,
                              didOpen: () => {
                                  Swal.showLoading();
                                  const timer = Swal.getPopup().querySelector("b");
                                  timerInterval = setInterval(() => {
                                  timer.textContent = `${Swal.getTimerLeft()}`;
                                  }, 100);
                              },
                              willClose: () => {
                                  clearInterval(timerInterval);
                              }
                          }).then((result) => {
                              window.location.href = "<?= route('admin') ?>";
                          });
                      } else {
                          btn.show()
                          loading.hide()
                          Swal.fire({
                              icon: 'error',
                              title: 'Login Gagal',
                              text: response.message
                          })
                      }
                  },
                  error: function (xhr, status, error) {
                    let response = JSON.parse(xhr.responseText)
                      btn.show()
                      loading.hide()
                      Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: response.message
                      })
                  }
              })
          })
      });
    </script>
  </body>
</html>