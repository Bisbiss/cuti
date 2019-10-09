<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <?php
              if (isset($_GET['insert'])) {
                if ($_GET['insert']=='false') {
                  ?>
                  <br>
                  <div class="alert alert-light" role="alert">
                    <strong>Data Gagal ditambah</strong>
                  </div>
                  <?php
                }
            }
            ?>
          <br>
          <div class="callout callout-info">
            <h5>Tambah Karyawan</h5>
          </div>
        </div><!-- /.col -->
      </div><!-- /.row -->

      <div class="row">
          <div class="col-md">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Formulir Tambah Karyawan</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="<?php echo base_url('karyawan/tambah'); ?>" method="post">
                    <div class="card-body">
                    <div class="form-group">
                        <label for="inputNPM" class="col-sm-4 control-label">Id Karyawan</label>

                        <div class="col-sm">
                        <input type="text" class="form-control" id="inputNPM" name="id_karyawan" maxlength="5" placeholder="Masukan Id Karyawan" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">Nama Karyawan</label>

                        <div class="col-sm">
                        <input type="text" class="form-control" id="inputName" name="nama" placeholder="Masukan Nama Karyawan" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputpass" class="col-sm-4 control-label">Password</label>

                        <div class="col-sm">
                        <input type="text" class="form-control" id="inputpass" name="password" placeholder="Masukan Password" required>
                        </div>
                    </div>
                    <!-- select -->

                    <div class="form-group">
                        <label for="inputNo" class="col-sm-4 control-label">Email</label>

                        <div class="col-sm">
                        <input type="text" class="form-control" id="inputNo" name="email" placeholder="Masukan Email" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="tgl_masuk" class="col-sm-4 control-label">Tanggal Masuk</label>

                        <div class="col-sm">
                        <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" placeholder="Tanggal Masuk" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tgl_masuk" class="col-sm-4 control-label">Jabatan</label>

                        <div class="col-sm">
                          <select class="form-control" id="jabatan" name="jabatan" required>
                            <option value="1">Karyawan</option>
                            <option value="2">Manager</option>
                            <option value="3">HRD</option>
                          </select>
                        </div>
                    </div>
                    
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    <button type="submit" class="btn btn-success" style="float:right">Daftar</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
                </div>
          </div>
      </div>

    </div><!-- /.container-fluid -->
  </section>
<!-- /.content -->
</div>