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
            <h5>Edit Karyawan</h5>
          </div>
        </div><!-- /.col -->
      </div><!-- /.row -->

      <div class="row">
          <div class="col-md">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Edit Tambah Karyawan</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="<?php echo base_url('karyawan/ubah_su'); ?>" method="post">
                    <div class="card-body">
                    <?php
                    foreach ($data as $data){
                    ?>
                    <div class="form-group">
                        <label for="inputNPM" class="col-sm-4 control-label">Id Karyawan</label>

                        <div class="col-sm">
                        <input type="text" class="form-control" id="inputNPM" name="id_karyawan" maxlength="5" value="<?php echo $data->id_user ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">Nama Karyawan</label>

                        <div class="col-sm">
                        <input type="text" class="form-control" id="inputName" name="nama" value="<?php echo $data->nama ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputpass" class="col-sm-4 control-label">Password</label>

                        <div class="col-sm">
                        <input type="text" class="form-control" id="inputpass" name="password" value="<?php echo $data->password ?>" required>
                        </div>
                    </div>
                    <!-- select -->

                    <div class="form-group">
                        <label for="inputNo" class="col-sm-4 control-label">Email</label>

                        <div class="col-sm">
                        <input type="text" class="form-control" id="inputNo" name="email" value="<?php echo $data->email ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="tgl_masuk" class="col-sm-4 control-label">Tanggal Masuk</label>

                        <div class="col-sm">
                        <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" value="<?php echo $data->tanggal_masuk ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="kuota" class="col-sm-4 control-label">Kuota Cuti <?php echo date('Y')-1 ?></label>
                        <div class="col-sm">
                        <input type="number" class="form-control" id="kuota" name="kuota_cuti_sebelumnya" value="<?php echo $data->kuota_cuti_sebelumnya ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="kuota" class="col-sm-4 control-label">Kuota Cuti <?php echo date('Y')?></label>

                        <div class="col-sm">
                        <input type="number" class="form-control" id="kuota" name="kuota_cuti" value="<?php echo $data->kuota_cuti ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="kuota" class="col-sm-4 control-label">Kuota Cuti <?php echo date('Y')+1 ?></label>
                        <div class="col-sm">
                        <input type="number" class="form-control" id="kuota" name="kuota_cuti_setelahnya" value="<?php echo $data->kuota_cuti_setelahnya ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jabatan" class="col-sm-4 control-label">Jabatan</label>

                        <div class="col-sm">
                          <select class="form-control" id="jabatan" name="jabatan" required>
                            <option value="1" <?php if ($data->level==1)echo 'selected'; ?>>Karyawan</option>
                            <option value="2" <?php if ($data->level==2)echo 'selected'; ?>>Manager</option>
                            <option value="3" <?php if ($data->level==3)echo 'selected'; ?>>HRD</option>
                            <option value="4" <?php if ($data->level==4)echo 'selected'; ?>>Admin</option>
                          </select>
                        </div>
                    </div>
                    
                    </div>
                    <?php 
                    }
                    ?>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    <button type="submit" class="btn btn-success" style="float:right">Edit</button>
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