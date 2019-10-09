<section class="content">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <br>
          <div class="callout callout-info">
            <h5>Welcome:</h5>
            Selamat Datang <b><?php echo $this->session->userdata('nama') ?></b> Di Sistem Informasi E-Cuti
          </div>
        </div><!-- /.col -->
      </div><!-- /.row -->

      <div class="row">
        <div class="col-md">
          <div class="card text-center">
            <div class="card-header">
              Home
            </div>
            <div class="card-body">
              <img src="<?php echo base_url('assets/img/Logo.jpg')?>" class="img-fluid" width="60%">
            </div>
          </div>
        </div>
      </div>

      <div class="row">
      <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              <h3>Kuota Cuti <?php echo date('Y')-1 ?></h3>
            </div>
            <div class="card-body">
              <?php
                foreach ($data as $data) {
                  echo "<h1 class='text-right text-bold'>".$data->kuota_cuti_sebelumnya."</h1>";
              ?>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              <h3>Kuota Cuti <?php echo date('Y') ?></h3>
            </div>
            <div class="card-body">
              <?php
                echo "<h1 class='text-right text-bold'>".$data->kuota_cuti."</h1>";                  
              ?>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              <h3>Kuota Cuti <?php echo date('Y')+1 ?></h3>
            </div>
            <div class="card-body">
              <?php
                  echo "<h1 class='text-right text-bold'>".$data->kuota_cuti_setelahnya."</h1>";
                }
              ?>
            </div>
          </div>
        </div>

      </div>
    </div><!-- /.container -->
  </section>
<!-- /.content -->
</body>