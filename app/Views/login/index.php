<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" type="image/svg+xml" href='data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="38" height="38"><circle cx="19" cy="19" r="19" fill="%23c89b5a"/><text x="50%" y="54%" text-anchor="middle" dominant-baseline="middle" fill="white" font-size="22" font-family="Arial" font-weight="700">S</text></svg>'>
  <title>SHILOU | Login</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?= base_url('public/plugins/fontawesome-free/css/all.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('public/dist/css/adminlte.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('public/dist/css/adminlte.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('public/plugins/sweetalert2/sweetalert2.css') ?>">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card">
      <div class="card-header text-center" style="background: rgba(249, 245, 240, 0.9);">
        <span style="color: #c89b5a; font-size: 1.7rem; font-weight: bold;">SHILOU</span>
      </div>
      <div class="card-body login-card-body">
        <div class="input-group mb-4 mt-3">
          <input type="text" class="form-control" id="txtusuario" placeholder="Ingrese su usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-4">
          <input type="password" class="form-control" id="txtpassword" placeholder="Ingrese su contraseña">
          <div class="input-group-append">
            <div class="input-group-text" style="cursor:pointer;" id="togglePassword">
              <span class="fas fa-eye-slash" id="iconPassword"></span>
            </div>
          </div>
        </div>
        <div class="text-center mb-3">
          <button type="button" class="btn btn-block g-recaptcha"
            data-sitekey="<?= $recaptcha_site_key ?>"
            data-callback='onSubmit'
            data-action='submit'
            style="background: #c89b5a; color: #fff; font-size: 1rem; font-weight: 500;">
            <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i> Iniciar Sesión
          </button>
        </div>
        <div class="text-center mb-0">
          <a href="#" id="openModal" style="color: #c89b5a; font-weight: 500;">Olvidé mi contraseña</a>
        </div>
      </div>
    </div>
  </div>

  <!------------------------------------------------- MODAL RECUPERAR CONTRASEÑA -------------------------------------------------------------->
  <div class="modal fade" id="modalrecuperarpsw" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalDefaultLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background: rgba(249, 245, 240, 0.9);">
          <h4 class="modal-title" id="modalDefaultLabel">Restablecer contraseña</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Ingrese sus credenciales para restablecer su contraseña.</p>
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="txtUsername" placeholder="Nombre de usuario">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="email" class="form-control" id="txtEmail" placeholder="Correo electrónico">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" onclick="enviarCredencialesCorreo()">Enviar correo</button>
        </div>
      </div>
    </div>
  </div>

  <script src="<?= base_url('public/plugins/jquery/jquery.min.js') ?>"></script>
  <script src="<?= base_url('public/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('public/dist/js/adminlte.min.js') ?>"></script>
  <script src="<?= base_url('public/plugins/sweetalert2/sweetalert2.js') ?>"></script>
  <script src="https://www.google.com/recaptcha/api.js"></script>
  <script src="<?= base_url('public/dist/js/pages/login.js') ?>"></script>
  <script>
    var baseURL = '<?= base_url(); ?>';
  </script>
</body>
</html>