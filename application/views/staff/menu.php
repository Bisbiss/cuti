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
		    <a class="nav-link" data-toggle="modal" data-target="#exampleModal">Ajukan Cuti</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" href="<?php echo base_url('staff/riwayat') ?>">Riwayat Cuti</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" href="<?php echo base_url('welcome/logout')?> ">Keluar</a>
		  </li>
		</ul>
	</div>
</nav>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pilih Jenis Cuti</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form action="" method="post">
      <div class="modal-body">
	  	<div class="form-group">
			<label for="leavetype" class="col-sm-4 control-label">Leave type</label>

			<div class="col-sm">
			<select class="form-control" id="leavetype" name="jenis" required>
				<option value="Reguler">Reguler</option>
				<option value="Urgent">Urgent</option>
			</select>
			</div>
		</div>
		<span>Reguler : Cuti hanya dapat diajukan H-7 sebelum cuti</span> <br>
		<span>note : Urgent digunakan untuk cuti mendadak</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </div>
	  </form>
    </div>
  </div>
</div>
<?php
if (isset($_POST['submit'])) {
	$jenis = $_POST['jenis'];
	if ($jenis =='Reguler' ) {
		redirect(base_url('staff/cuti'));
	} else {
		redirect(base_url('staff/cuti_urgent'));
	}
		
}

?>