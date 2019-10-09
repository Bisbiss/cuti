<section class="content">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <br>
          <div class="callout callout-info">
            <h5>Formulir Pengajuan Cuti</h5>
          </div>
        </div><!-- /.col -->
      </div><!-- /.row -->

      <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                </div>
                <?php
                    foreach ($data as $data) {
                    ?>
                    <form action="<?php echo base_url('karyawan/cuti') ?>" method="post" name="cuti">
                <div class="card-body">
                    <div class="form-group">
                        <label for="Nama" class="col-sm-4 control-label">Name</label>

                        <div class="col-sm">
                        <input type="text" class="form-control" id="Nama" name="nama" value="<?php echo $data->nama ?>" readonly>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="Nama" name="employe" value="<?php echo $data->employe_manager ?>" readonly>
                    <div class="form-group">
                        <label for="leavetype" class="col-sm-4 control-label">Leave type</label>

                        <div class="col-sm">
                        <select class="form-control" id="leavetype" name="leavetype" required>
                            <option value="Annual Leave">Annual Leave</option>
                            <option value="Casual Leave">Casual Leave</option>
                        </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="date" class="col-sm-4 control-label">Date</label>

                        <div class="row">
                            <div class="col-sm">
                                <input type="date" class="form-control" id="date" name="start_date" required>
                            </div>
                            <div class="col-sm">
                                <input type="date" class="form-control" id="date2" name="end_date" onFocus="startCalculate()" onBlur="stopCalc();" required>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="total" class="col-sm-4 control-label">Total Days</label>

                        <div class="col-sm">
                        <input type="number" class="form-control" id="total" name="total" onfocus="startCalculate()" onblur="stopCalc()">
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label for="reason" class="col-sm-4 control-label">Reason</label>

                        <div class="col-sm">
                        <textarea name="reason" id="reason" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success" style="float:right">Submit</button>
                </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                <h3>Kuota Cuti</h3>
                </div>
                <div class="card-body">
                    <table>
                        <tr>
                            <td><h3>Kuota <?php echo date('Y')-1 ?> : </h3></td>
                            <td><h3><?php echo $data->kuota_cuti_sebelumnya ?></h3></td>
                        </tr>   
                        <tr>
                            <td><h3>Kuota <?php echo date('Y') ?> : </h3></td>
                            <td><h3><?php echo $data->kuota_cuti?></h3></td>
                        </tr>
                        <tr>
                            <td><h3>Kuota <?php echo date('Y')+1 ?> : </h3></td>  
                            <td><h3><?php echo $data->kuota_cuti_setelahnya; }?></h3></td>                          
                        </tr>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </div>
</section>
</body>