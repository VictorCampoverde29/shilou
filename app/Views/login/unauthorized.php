<?= $this->extend('dashboard/template'); ?>
<?= $this->section('title'); ?>
Shilou | Usuarios
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper" style="min-height: 1604.8px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="error-page" style="margin-top: 100px;">
        <h2 class="headline text-danger" style="margin-top: 0;">500</h2>

        <div class="error-content" style="margin-top: 0; padding-top: 0;">
          <h3 style="margin-top: 0.5rem;"><i class="fas fa-exclamation-triangle text-danger"></i> Oops! No cuenta con acceso.</h3>

          <p style="font-size: 1.1rem; margin-top: 0.5rem;">
            No tiene acceso para estar aqui.<br>
            <a href="<?= base_url('head/index')?>">Regresar al Inicio </a> o comuniquese con el administrador.
          </p>
        </div>
      </div>
  </section>
</div>

<?= $this->endSection(); ?>