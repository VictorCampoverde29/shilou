<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/svg+xml" href='data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="38" height="38"><circle cx="19" cy="19" r="19" fill="%23c89b5a"/><text x="50%" y="54%" text-anchor="middle" dominant-baseline="middle" fill="white" font-size="22" font-family="Arial" font-weight="700">S</text></svg>'>
  <title><?= $this->renderSection('title'); ?></title>
  <?= $this->renderSection('styles'); ?>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?= base_url('public/plugins/fontawesome-free/css/all.min.css') ?>">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= base_url('public/dist/css/adminlte.min.css') ?>">
  <style>
    .brand-link:hover .brand-text {
      color: #c89b5a !important;
      background: transparent !important;
    }

    .main-header.navbar,
    .main-sidebar {
      background: #fff !important;
    }

    .main-header .navbar-nav .nav-link,
    .main-header .navbar-nav .nav-link i {
      color: #c89b5a !important;
      background: transparent !important;
    }

    .main-header .navbar-nav .nav-link:hover,
    .main-header .navbar-nav .nav-link:focus {
      color: #c89b5a !important;
      background: transparent !important;
    }

    .nav-sidebar .nav-link,
    .nav-sidebar .nav-icon {
      color: #c89b5a !important;
    }

    .nav-sidebar .nav-link.active,
    .nav-sidebar .nav-link:hover {
      color: #fff !important;
      background: #c89b5a !important;
    }

    .nav-sidebar .nav-link:hover .nav-icon {
      color: #fff !important;
    }

    .nav-sidebar .nav-link:hover p,
    .nav-sidebar .nav-link:hover span,
    .nav-sidebar .nav-link:hover {
      color: #fff !important;
    }

    .main-sidebar,
    .main-sidebar .sidebar {
      background: rgba(249, 245, 240, 0.9) !important;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <?= $this->include('Views/dashboard/nav') ?>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <?= $this->include('Views/dashboard/aside') ?>
    <!-- Content Wrapper. Contains page content -->
    <?= $this->renderSection('content'); ?>
    <!-- /.content-wrapper -->
    <!-- Main Footer -->
    <?= $this->include('Views/dashboard/footer') ?>
  </div>
  <!------------------------------------------------- MODAL NUEVA CONTRASEÑA -------------------------------------------------------------->
  <div class="modal fade" id="mdlcambio" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalDefaultLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header" style="background: rgba(249, 245, 240, 0.9);">
          <h4 class="modal-title" id="modalDefaultLabel">Cambiar Contraseña</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-sm-12">
            <input type="hidden" id="txtuser" name="txtuser">
            <div class="form-group">
              <label for="txtpasswordc">Ingrese su nueva contraseña</label>
              <div class="input-group">
                <input type="password" class="form-control" id="txtpasswordc" placeholder="Password" autocomplete="off">
                <div class="input-group-append">
                  <div class="input-group-text" style="cursor:pointer;" id="cambioIcono">
                    <span class="fas fa-eye-slash" id="iconoPassword"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i> CANCELAR</button>
          <button type="button" class="btn btn-primary" onclick="guardarCambio()"><i class="fas fa-key"></i> CAMBIAR CLAVE</button>
        </div>
      </div>
    </div>
  </div>
  <!-- ./wrapper -->
  <!-- REQUIRED SCRIPTS -->
  <script src="<?= base_url('public/plugins/jquery/jquery.min.js') ?>"></script>
  <script src="<?= base_url('public/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('public/dist/js/adminlte.js?v=3.2.0') ?>"></script>
  <script src="<?= base_url('public/plugins/sweetalert2/sweetalert2.all.min.js') ?>"></script>
  <script src="<?= base_url('public/dist/js/pages/generales.js?v=' . env('VERSION')) ?>"></script>

  <script>
    var baseURL = '<?= base_url(); ?>';
  </script>
  <?= $this->renderSection('scripts'); ?>
</body>

</html>