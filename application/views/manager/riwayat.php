<section class="content">
    <div class="container">
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
                            <th width="15%" class="text-center">Leave Type </th>
                            <th width="10%" class="text-center">Start</th>
                            <th width="10%" class="text-center">End</th>
                            <th width="13%" class="text-center">Total Day</th>
                            <th width="22%" class="text-center">Reason</th>
                            <th width="10%" class="text-center">Status</th>
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
                                    <?php if ($data->status == 'm') {
                                        echo "<span class='badge badge-info'>On Process</span>";
                                    } else if ($data->status == 'v'){
                                        echo "<span class='badge badge-success'>Approve</span>";
                                    }else{
                                        echo "<span class='badge badge-danger'>Disappove</span>";
                                    }
                                    ?>
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