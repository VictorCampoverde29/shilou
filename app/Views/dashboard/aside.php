<aside class="main-sidebar" style="background: rgba(249, 245, 240, 0.9);" elevation-2>
  <!-- Brand Logo -->
  <a href="<?= base_url('') ?>" class="brand-link d-flex flex-column align-items-center" style="padding-top: 18px; padding-bottom: 18px;">
    <img src="<?= base_url('public/dist/img/shilourec.png') ?>" alt="SHILOU" style="height: 90px; width: 95px; margin-top: 6px; margin-bottom: 6px;" />
  </a>
  <!-- Sidebar -->
  <div class="sidebar" style="background: rgba(249, 245, 240, 0.9);">
    <!-- Sidebar Menu -->
    <nav class="admin-menu">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="<?= base_url('head/index') ?>" class="nav-link">
            <i class="fas fa-star nav-icon"></i>
            <p>HEAD</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('servicios/index') ?>" class="nav-link">
            <i class="fas fa-spa nav-icon"></i>
            <p>SERVICIOS</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('galeria/index') ?>" class="nav-link">
            <i class="fas fa-images nav-icon"></i>
            <p>GALERIA</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('testimonios/index') ?>" class="nav-link">
            <i class="fas fa-comments nav-icon"></i>
            <p>TESTIMONIOS</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('contacto/index') ?>" class="nav-link">
            <i class="fas fa-phone-alt nav-icon"></i>
            <p>CONTACTO</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('usuarios/index') ?>" class="nav-link">
            <i class="fas fa-users nav-icon"></i>
            <p>USUARIOS</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>