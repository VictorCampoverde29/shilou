<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('public/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('public/dist/css/adminlte.css') ?>">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="../../index2.html"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
      <div class="col-lg-12">
        <div class="white_box mb_30">
          <div class="row justify-content-center">
            <div class="col-lg-6">
              <!-- sign_in  -->
              <div class="modal-content cs_modal">
                <div class="modal-header justify-content-center theme_bg_1">
                  <h5 class="modal-title text_white">Log in</h5>
                </div>
                <div class="modal-body">
                  <form>
                    <div class="">
                      <input type="text" class="form-control" placeholder="Enter your email">
                    </div>
                    <div class="">
                      <input type="password" class="form-control" placeholder="Password">
                    </div>
                    <a href="#" class="btn_1 full_width text-center">Log in</a>
                    <p>Need an account? <a data-toggle="modal" data-target="#sing_up" data-dismiss="modal" href="#"> Sign Up</a></p>
                    <div class="text-center">
                      <a href="#" data-toggle="modal" data-target="#forgot_password" data-dismiss="modal" class="pass_forget_btn">Forget Password?</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?= base_url('public/plugins/jquery/jquery.min.js') ?>"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('public/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('public/dist/js/adminlte.min.js') ?>"></script>
  <script>
    var baseURL = '<?= base_url(); ?>';
  </script>
</body>

</html>