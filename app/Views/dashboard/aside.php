<aside class="main-sidebar" style="background: rgba(249, 245, 240, 0.9);" elevation-2>
  <!-- Brand Logo -->
  <a href="<?= base_url('dashboard') ?>" class="brand-link d-flex flex-column align-items-center" style="padding-top: 18px; padding-bottom: 18px;">
    <span class="brand-text font-weight-bold" style="font-size: 1.6rem; letter-spacing: 0.08em; margin-top: 6px; margin-bottom: 6px; text-align: center; color: #c89b5a; transition: color 0.2s;">SHILOU</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar" style="background: rgba(249, 245, 240, 0.9);">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="<?= base_url('servicios/index') ?>" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Servicios</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('galeria/index') ?>" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Galeria</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url() ?>" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Top Navigation</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url() ?>" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Top Navigation + Sidebar</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>