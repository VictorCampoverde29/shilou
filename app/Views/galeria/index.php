<?= $this->extend('dashboard/template'); ?>
<?= $this->section('styles'); ?>
<link rel="stylesheet" href="<?= base_url('public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('public/plugins/sweetalert2/sweetalert2.css') ?>">
<style>
  /* Imágenes de la galería con tamaño fijo y ajuste uniforme */
  #contenedorCards .card-body img.img-fluid {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border: 2px solid #c89b5a;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    background: #fff;
    display: block;
  }
  /* Borde para las imágenes dentro de los cards */
  #contenedorCards .card-body img.img-fluid {
    border: 2px solid #a7a3a3ff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
  }
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
        <div class="col-12 col-sm-12">
            <div class="card card-row card-warning">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label d-block">Imagen</label>
                            <input type="hidden" id="txtidgaleria" name="txtidgaleria" value="">
                            <img src="" alt="" class="img-fluid" data-original="" style="max-height:200px;object-fit:cover;">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <input type="text" class="form-control form-control-sm" id="txtnombre" readonly placeholder="Nombre de la imagen">
                        </div>
                    </div>
                    <div class="row mb-2 justify-content-center">
                        <div class="col-12 d-flex justify-content-between">
                            <div>
                                <label for="txtimagen" class="form-label"></label>
                                <input type="file" accept="image/*" class="d-none" data-iddetalle="${item.iddetalle}" id="txtimagen">
                                <button type="button" class="btn btn-default btn-sm" data-iddetalle="${item.iddetalle}" title="Explorador de Archivos" onclick="abrirExplorador(this)">
                                    <i class="fas fa-folder-open"></i> ARCHIVOS
                                </button>
                            </div>
                            <div>
                                <button type="button" class="btn btn-default btn-sm" onclick="abrirModalLocal(this)" title="Imágenes guardadas">
                                    <i class="fas fa-images"></i> GALERIA
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3 justify-content-center">
                        <div class="col-12">
                            <label for="txtdetalle" class="form-label">Título</label>
                            <input type="text" class="form-control" placeholder="Título de la imagen" id="txtdetalle">
                        </div>
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
<!------------------------------------------------- MODAL NUEVO DETALLE SERVICIO -------------------------------------------------------------->
<div class="modal fade" id="mdlGaleriaLocal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalDefaultLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background: rgba(249, 245, 240, 0.9);">
        <h4 class="modal-title" id="modalDefaultLabel">Imagenes Guardadas</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header bg-primary">
                <h3 class="card-title">Imágenes Locales</h3>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-sm" id="tblgalerialocal" style="width:100%">
                    <thead class="bg-dark">
                      <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Contenido dinámico -->
                    </tbody>
                  </table>
                </div>
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
<script src="<?= base_url('public/dist/js/pages/galeria.js') ?>"></script>
<script src="<?= base_url('public/dist/js/pages/generales.js') ?>"></script>
<?= $this->endSection(); ?>