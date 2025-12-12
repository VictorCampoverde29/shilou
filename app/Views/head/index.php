<?= $this->extend('dashboard/template'); ?>
<?= $this->section('title'); ?>
Shilou | Head
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
          <h1>Head</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card card-solid card-outline card-primary">
      <div class="card-body">
        <div class="row">
          <input type="hidden" class="form-control" id="txtid">
          <div class="col-12 col-sm-4">
            <div class="form-group">
              <label for="txttitulos"> Título:</label>
              <input type="text" class="form-control" autocomplete="off" placeholder="Título de la Galería" id="txttitulos">
            </div>
          </div>
          <div class="col-12 col-sm-4">
            <div class="form-group">
              <label for="txttituloresaltado"> Título Resaltado:</label>
              <input type="text" class="form-control" id="txttituloresaltado" autocomplete="off" placeholder="Título Resaltado">
            </div>
          </div>
          <div class="col-12 col-sm-4">
            <div class="form-group">
              <label for="txttitulo2"> Título Extra:</label>
              <input type="text" class="form-control" id="txttitulo2" autocomplete="off" placeholder="Título Extra">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-sm-12">
            <div class="form-group">
              <label for="txtdetalles"> Detalle:</label>
              <textarea class="form-control mb-3" id="txtdetalles" autocomplete="off" placeholder="Detalle de la Galería"></textarea>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="txttelefono"> Telefono:</label>
              <input type="text" class="form-control" id="txttelefono" autocomplete="off" placeholder="Teléfono de contacto">
            </div>
          </div>
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="txtdireccion"> Dirección:</label>
              <input type="text" class="form-control" id="txtdireccion" autocomplete="off" placeholder="Dirección de contacto">
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-12 col-sm-12">
            <div class="mt-2">
              <div class="btn btn-primary" onclick="editar()">
                <i class="fas fa-save fa-lg mr-2"></i>
                Guardar
              </div>
              <div class="btn btn-default" onclick="limpiar()">
                <i class="fas fa-eraser fa-lg mr-2"></i>
                Limpiar
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card card-solid card-outline card-oro">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="card-title">Detalle</h5>
          <button type="button" class="btn btn-default" onclick="abrirModal()">+ Nuevo Card</button>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <input type="hidden" class="form-control" id="txtidd">
          <div class="col-12 col-sm-12">
            <div class="form-group">
              <label for="txttitulosdet"> Título:</label>
              <input type="text" class="form-control" autocomplete="off" placeholder="Título de la Galería" id="txttitulosdet">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-sm-12">
            <div class="form-group">
              <label for="txtdetallesdet"> Detalle:</label>
              <textarea class="form-control mb-3" id="txtdetallesdet" autocomplete="off" placeholder="Detalle de la Galería"></textarea>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-12 col-sm-12">
            <div class="mt-2">
              <div class="btn btn-success" onclick="editarDetalle()">
                <i class="fas fa-save fa-lg mr-2"></i>
                Guardar
              </div>
              <div class="btn btn-default" onclick="limpiarDetalle()">
                <i class="fas fa-eraser fa-lg mr-2"></i>
                Limpiar
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
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
<script src="<?= base_url('public/dist/js/pages/head.js') ?>"></script>
<?= $this->endSection(); ?>