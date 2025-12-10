<?= $this->extend('dashboard/template'); ?>
<?= $this->section('title'); ?>
Shilou | Testimonios
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
          <h1>Testimonios</h1>
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
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="txttitulos"> Título:</label>
              <input type="text" class="form-control" autocomplete="off" placeholder="Título de la Galería" id="txttitulos">
            </div>
          </div>
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="txttituloresaltado"> Título Subrayado:</label>
              <input type="text" class="form-control" id="txttituloresaltado" autocomplete="off" placeholder="Título Subrayado de la Galería">
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
          <h5 class="card-title">Testimonios de los Clientes</h5>
          <button type="button" class="btn btn-default" onclick="abrirModal()">+ Nuevo Testimonio</button>
        </div>
      </div>
      <div class="card-body">
        <section class="content pb-3">
          <div class="container-fluid h-100">
            <div class="row" id="contenedorCards">
              <!-- Aquí se cargarán los cards dinámicamente -->
            </div>
          </div>
        </section>
      </div>
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!------------------------------------------------- MODAL NUEVO DETALLE SERVICIO -------------------------------------------------------------->
<div class="modal fade" id="mdldetalle" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalDefaultLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background: rgba(249, 245, 240, 0.9);">
        <h4 class="modal-title" id="modalDefaultLabel">Agregar nuevo Card</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-sm-12">
          <input type="hidden" id="iddetalle" name="iddetalle">
          <div class="form-group">
            <label for="txtcliente">Cliente</label>
            <input type="text" class="form-control" id="txtcliente" name="txtcliente" autocomplete="off" placeholder="Nombre del Cliente">
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="txtcomentario">Testimonio</label>
                <textarea class="form-control" id="txtcomentario" name="txtcomentario" autocomplete="off" placeholder="Testimonio del Cliente"></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="cmbservicio">Servicio</label>
                <select class="form-control" id="cmbservicio" name="cmbservicio">
                  <?php foreach ($servicios as $servicio): ?>
                    <option value="<?= esc($servicio['titulo']); ?>">
                      <?= esc($servicio['titulo']); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="cmbestado">Estado</label>
                <select class="form-control" id="cmbestado" name="cmbestado">
                  <option value="INACTIVO">INACTIVO</option>
                  <option value="ACTIVO">ACTIVO</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="registrarDetalle()"><i class="fas fa-plus"></i> Agregar</button>
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
<script src="<?= base_url('public/dist/js/pages/testimonios.js') ?>"></script>
<script src="<?= base_url('public/dist/js/pages/generales.js') ?>"></script>
<?= $this->endSection(); ?>