<style>
  .nav-link:hover{
    background-color :#12418c;
    border-radius : 2px;
    color : white;
  }

  body{
    background-color:#dcded7;
  }
</style>

<body>
<!-- Just an image -->
<nav class="navbar bg-primary">
	<div class="container">
	  <a class="navbar-brand" href="<?php echo base_url('staff') ?>">
      <span>E-Cuti</span>
	  </a>

	  	<ul class="nav justify-content-end">
		  <li class="nav-item">
		    <a class="nav-link" href="<?php echo base_url('hrd/pengajuan') ?>">Pengajuan Cuti</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" href="<?php echo base_url('hrd/cuti') ?>">Ajukan Cuti</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" href="<?php echo base_url('hrd/riwayat') ?>">Riwayat Cuti</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" href="<?php echo base_url('welcome/logout')?> ">Keluar</a>
		  </li>
		</ul>
	</div>
</nav>