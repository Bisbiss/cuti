<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md">
        <br>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Cuti</h3>
                </div>

                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped table-responsive">
                        <thead>
                            <th width="5%" class="text-center">No</th>
                            <th width="15%" class="text-center">Name</th>
                            <th width="10%" class="text-center">Leave Type </th>
                            <th width="10%" class="text-center">Start</th>
                            <th width="10%" class="text-center">End</th>
                            <th width="7%" class="text-center">Total Day</th>
                            <th width="18%" class="text-center">Reason</th>
                            <th width="10%" class="text-center">Status</th>
                            <th width="15%" class="text-center">Action</th>
                        </thead>
                    
                        <tbody>
                            <?php
                                $id = 0;
                                foreach ($data as $data) :
                                $id++;
                            ?>
                            <tr>
                                <td>
                                    <?php echo $id; ?>
                                </td>
                                <td>
                                    <?php echo $data->nama ?>
                                </td>
                                <td>
                                    <?php echo $data->leave_type ?>
                                </td>
                                <td>
                                    <?php echo $data->start_date ?>
                                </td>
                                <td>
                                    <?php echo $data->end_date ?>
                                </td>
                                <td>
                                    <?php echo $data->total ?>
                                </td>
                                <td>
                                    <?php echo $data->reason ?>
                                </td>
                                <td>
                                    <?php if ($data->status == 'r') {
                                        echo "<span class='badge badge-danger'>Disappove</span>";
                                    } else if ($data->status == 'v'){
                                        echo "<span class='badge badge-success'>Approve</span>";
                                    }else if ($data->status == 'c'){
                                        echo "<span class='badge badge-success'>Checking</span>";
                                    }else{
                                        echo "<span class='badge badge-info'>On Process</span>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php if ($data->status == 'c'){?>
                                        <a href="<?php echo base_url('email/sending/'.$data->id_cuti) ?>"><i class="fa fa-edit"></i> Ajukan</a> |
                                        <a href="hapus/<?php echo $data->id_cuti ?>" style="color:red">Hapus <i class="fa fa-trash"></i></a>
                                    <?php }else {
                                        echo "<center>--------</center>";
                                    } ?>
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
      </div>
    </div>
</section>
</body>