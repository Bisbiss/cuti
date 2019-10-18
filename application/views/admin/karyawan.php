<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <?php
              if (isset($_GET['delete'])) {
                if ($_GET['delete']=='true') {
                  ?>
                  <br>
                  <div class="alert alert-light" role="alert">
                    <strong>Data Berhasil di hapus</strong>
                  </div>
                  <?php
                }
                }if (isset($_GET['insert'])) {
                    if ($_GET['insert']=='true') {
                      ?>
                      <br>
                      <div class="alert alert-info" role="alert">
                        <strong>Data Berhasil ditambah</strong>
                      </div>
                      <?php
                    }
                    }
                    if (isset($_GET['update'])) {
                        if ($_GET['update']=='true') {
                          ?>
                          <br>
                          <div class="alert alert-success" role="alert">
                            <strong>Data Berhasil diubah</strong>
                          </div>
                          <?php
                        }
                        }
            ?>
                <br>
                <div class="callout callout-info">
                    <h5>Kelola Karyawan</h5>
                </div>
            </div><!-- /.col -->
        </div>

        <div class="row">
            <div class="col-md">
            <br>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="float:left">Kelola Karyawan</h3>
                        <h3 class="card-title" style="float:right">
                        <a href="<?php echo base_url('admin/cetak') ?>">   
                            <i class="nav-icon fa fa-download"> Export Data</i>
                        </a>
                        </h3>
                        <h3 class="card-title" style="float:right">
                        <a href="<?php echo base_url('admin/tambahKaryawan') ?>">   
                            <i class="nav-icon fa fa-plus-square"> Tambah Karayawan |</i>
                        </a>
                        </h3>
                    </div>

                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <th width="5%" class="text-center">No</th>
                                <th width="8%" class="text-center">Id Karyawan</th>
                                <th width="15%" class="text-center">Nama</th>
                                <th width="15%" class="text-center">Password</th>
                                <th width="17%" class="text-center">Email</th>
                                <th width="20%" class="text-center">Jabatan</th>
                                <th width="10%" class="text-center">Kuota Cuti</th>
                                <th width="10%" class="text-center">Kelola</th>
                            </thead>
                        
                            <tbody>
                                <?php
                                    $id = 0;
                                    foreach ($karyawan as $karyawan) :
                                    $id++;
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $id; ?>
                                    </td>
                                    <td>
                                        <?php echo $karyawan->id_user ?>
                                    </td>
                                    <td>
                                        <?php echo $karyawan->nama ?>
                                    </td>
                                    <td>
                                        <?php echo $karyawan->password ?>
                                    </td>
                                    <td>
                                        <?php echo $karyawan->email ?>
                                    </td>
                                    <td>
                                        <?php if ($karyawan->level==0){
                                            echo "Non Staff";
                                        } else if($karyawan->level==1){
                                            echo "Staff";
                                        } else if($karyawan->level==2){
                                        echo "Manager";
                                        } else if($karyawan->level==3){
                                        echo "HRD";
                                        } else if($karyawan->level==4){
                                        echo "Admin";
                                        } ?>
                                    </td>
                                    <td>
                                        <?php echo $karyawan->kuota_cuti ?>
                                    </td>
                                    <td>
                                        <a href="ubah/<?php echo $karyawan->id_user ?>"><i class="fa fa-edit"></i> Ubah</a> <br>
                                        <a href="hapus/<?php echo $karyawan->id_user ?>" style="color:red"><i class="fa fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                                <?php
                                    endforeach
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
  </section>
<!-- /.content -->
</div>