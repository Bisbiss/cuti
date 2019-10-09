<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <!-- End Navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('admin') ?>" class="brand-link">
      <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8"> -->
      <span class="brand-text font-weight-light">E-CUTI</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-header">Menu</li>
          <li class="nav-item">
            <a href="<?php echo base_url('admin'); ?>" class="nav-link">
              <i class="nav-icon fa fa-home"></i>
              <p>Home</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('admin/pengajuan'); ?>" class="nav-link">
              <i class="nav-icon fa fa-calendar-o"></i>
              <p class="text">Kelola Cuti</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('admin/karyawan'); ?>" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>Kelola Karyawan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('welcome/logout'); ?>" class="nav-link">
              <i class="nav-icon fa fa-sign-out"></i>
              <p>Keluar</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>