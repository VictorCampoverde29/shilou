<?= $this->extend('dashboard/template'); ?>
<?= $this->section('title'); ?>
Shilou | Usuarios
<?= $this->endSection(); ?>
<?= $this->section('styles'); ?>
<link rel="stylesheet" href="<?= base_url('public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('public/plugins/sweetalert2/sweetalert2.css') ?>">
<style>
  .card-outline.card-oro {
    border-top: 3px solid #c89b5a !important;
  }
</style>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper" style="min-height: 1604.8px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Usuarios</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card card-solid card-outline card-primary">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          <h3 class="card-title">Usuarios Registrados</h3>
          <button type="button" class="btn btn-primary btn-sm" onclick="abrirModal()">+ NUEVO USUARIO</button>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-sm" id="tblusuarios" style="width:100%">
            <thead class="bg-dark">
              <tr>
                <th>NOMBRE</th>
                <th>CORREO</th>
                <th>PERFIL</th>
                <th>ESTADO</th>
                <th>ACCIONES</th>
              </tr>
            </thead>
            <tbody>
              <!-- Contenido dinámico -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!------------------------------------------------- MODAL NUEVO DETALLE SERVICIO -------------------------------------------------------------->
<div class="modal fade" id="mdlusuarios" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalDefaultLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: rgba(249, 245, 240, 0.9);">
        <h4 class="modal-title" id="modalDefaultLabel">Registrar nuevo Usuario</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" class="form-control" id="txtid">
        <div class="form-group">
          <label for="txtnombre"> Nombre:</label>
          <input type="text" class="form-control" id="txtnombre" placeholder="Nombre del Usuario" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="txtcontra"> Contraseña:</label>
          <input type="password" class="form-control" id="txtcontra" autocomplete="off" placeholder="Contraseña del Usuario">
        </div>
        <div class="form-group">
          <label for="txtcorreo"> Correo Electrónico:</label>
          <input type="email" class="form-control" id="txtcorreo" autocomplete="off" placeholder="Correo Electrónico del Usuario">
        </div>
        <div class="row">
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="txtperfil"> Perfil:</label>
              <select class="form-control" id="txtperfil">
                <option value="EDITOR">EDITOR</option>
                <option value="ADMINISTRADOR">ADMINISTRADOR</option>
              </select>
            </div>
          </div>
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="txtperfil"> Estado:</label>
              <select class="form-control" id="txtestado">
                <option value="ACTIVO">ACTIVO</option>
                <option value="INACTIVO">INACTIVO</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
        <button type="button" id="btnregistrar" name="btnregistrar" class="btn btn-primary mr-2" onclick="registrar()">
          <i class="fas fa-plus"></i> Registrar
        </button>
        <button type="button" id="btneditar" name="btneditar" class="btn btn-warning mr-2" onclick="editar()">
          <i class="fas fa-pencil-alt"></i> Editar
        </button>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
  var baseURL = '<?= base_url(); ?>';
</script>
<script src="<?= base_url('public/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('public/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('public/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('public/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('public/plugins/sweetalert2/sweetalert2.js') ?>"></script>
<script src="<?= base_url('public/dist/js/pages/usuarios.js?v=' . env('VERSION')) ?>"></script>
<?= $this->endSection(); ?>