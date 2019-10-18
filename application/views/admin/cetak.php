<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=employee.xls");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <br>
    <center><h2>Data Karyawan</h2></center>
    <br>
    <table border="1" width="100%">
    <thead>
    <tr>
        <th>Employee Id</th>
        <th>Employee Name</th>
        <th>Employee Email</th>
        <th>Employee Manager</th>
        <th>Hire Date</th>
        <th>Kuota Cuti <?php echo Date('Y')-1 ?></th>
        <th>Kuota Cuti <?php echo Date('Y') ?></th>
        <th>Kuota Cuti <?php echo Date('Y')+1 ?></th>
    </tr>
    </thead>
    <tbody>
    <?php
        foreach ($data as $data){
    ?>
    <tr>
        <td><?php echo $data->id_user ?></td>
        <td><?php echo $data->nama ?></td>
        <td><?php echo $data->email ?></td>
        <td><?php echo $data->employe_manager ?></td>
        <td><?php echo $data->tanggal_masuk ?></td>
        <td><?php echo $data->kuota_cuti_sebelumnya ?></td>
        <td><?php echo $data->kuota_cuti ?></td>
        <td><?php echo $data->kuota_cuti_setelahnya ?></td>
    </tr>
        <?php } ?>
    </tbody>
</body>
</html>
