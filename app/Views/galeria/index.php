<?= $this->extend('dashboard/template'); ?>
<?= $this->section('styles'); ?>
<link rel="stylesheet" href="<?= base_url('public/plugins/sweetalert2/sweetalert2.css') ?>">
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" />
<link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css" rel="stylesheet">
<style>
  .card-outline.card-oro {
    border-top: 3px solid #c89b5a !important;
  }

  .filepond--credits {
    display: none !important;
  }

  .filepond--root {
    background: #fff !important;
    border: 2px solid #007bff !important;
    /* azul */
    border-radius: 10px;
    box-shadow: none;
    width: 300px;
    /* más pequeño */
    margin: 0 auto;
  }

  .filepond--drop-label {
    color: #333;
    font-size: 1.1rem;
    font-weight: 500;
    text-align: center;
    padding: 30px 0;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 250px;
    /* altura fija para centrar verticalmente */
  }

  .filepond--panel-root {
    background: transparent !important;
    box-shadow: none !important;
  }

  .filepond--drop-label label {
    color: #007bff;
    text-decoration: none;
    /* sin subrayado por defecto */
    cursor: pointer;
    font-weight: bold;
  }

  .filepond--drop-label label:hover,
  .filepond--drop-label label:focus {
    text-decoration: underline;
    /* subrayado solo al pasar o seleccionar */
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
          <h1>Galería</h1>
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
              <input type="text" class="form-control" autocomplete="off" placeholder="Título del Servicio" id="txttitulos">
            </div>
          </div>
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="txttituloresaltado"> Título Subrayado:</label>
              <input type="text" class="form-control" id="txttituloresaltado" autocomplete="off" placeholder="Título Subrayado del Servicio">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-sm-12">
            <div class="form-group">
              <label for="txtdetalles"> Detalle:</label>
              <textarea class="form-control mb-3" id="txtdetalles" autocomplete="off" placeholder="Detalle del Servicio"></textarea>
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
      <div class="card-header border-0">
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="card-title">Catalogo</h5>
          <button type="button" class="btn btn-default" onclick="abrirModal()">+ Nuevo Card</button>
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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: rgba(249, 245, 240, 0.9);">
        <h4 class="modal-title" id="modalDefaultLabel">Agregar nuevo Servicio</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="txttitulosdet"> Título:</label>
          <input type="text" class="form-control" id="txttitulosdet" autocomplete="off" placeholder="Titulo del Servicio">
        </div>
        <div class="form-group">
          <label for="txtdetallesdet"> Detalle:</label>
          <textarea class="form-control" id="txtdetallesdet" autocomplete="off" placeholder="Detalle del Servicio"></textarea>
        </div>
        <div class="form-group">
          <label for="txticonosvg"> Icono:</label>
          <input type="text" class="form-control" id="txticonosvg" autocomplete="off" placeholder="Icono del Servicio">
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
<script src="<?= base_url('public/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('public/plugins/sweetalert2/sweetalert2.js') ?>"></script>
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
<script src="<?= base_url('public/dist/js/pages/galeria.js') ?>"></script>
<?= $this->endSection(); ?>