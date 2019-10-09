<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<body class="hold-transition login-page" id="login">

  <?php
    if (isset($_GET['pesan'])){
     $pesan = $_GET['pesan'];
        if($pesan='false') {
        ?>
        <br>
        <div class="alert alert-light" role="alert">
            <marquee><strong>Id atau Password Salah</strong></marquee>
        </div>
      <?php }
    }
  ?>
  <!-- <div class="col-md-4"> -->
    <!-- general form elements -->
    <div class="card login-box">
      <div class="card-header">
        <img src="<?php echo base_url('assets/img/Logo.jpg'); ?>" class="img-fluid">
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form" action="<?php echo base_url('welcome/login') ?> " method="post">
        <div class="card-body">
          <div class="form-group">
            <label for="inputUsername">Id Karyawan</label>
            <input type="text" class="form-control" name="id" maxlength="5" id="inputUsername" placeholder="Masukan Id Karyawan" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="password" required id="exampleInputPassword1" placeholder="Password">
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary" style="float:right">Login</button>
          <button type="reset" class="btn btn-gray" style="float:right">Reset</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
  <!-- </div> -->
  <!--/.col (left) -->
</body>