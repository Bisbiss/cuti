<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->model('ModelKaryawan');	
        $this->load->model('ModelCuti');	
    }

    function tambah(){
        $id_user = $_POST['id_karyawan'];
        $nama = $_POST['nama'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $tanggal_masuk = $_POST['tgl_masuk'];
        $jabatan = $_POST['jabatan'];
        $parseStart = explode("-",$tanggal_masuk);
        $parseEnd = explode("-",date('Y-m-d'));             
        $tahun = $parseEnd[0]-$parseStart[0];
        if($tahun >= 10){
            $kuota_cuti = 21;
        }else{
            $kuota_cuti = 12;
        } 

        $karyawan = array(
            'id_user' => $id_user,
            'nama' => $nama,
            'password' => $password,
            'email' => $email,
            'tanggal_masuk' => $tanggal_masuk,
            'level' => $jabatan,
            'kuota_cuti_sebelumnya' => $kuota_cuti,
            'kuota_cuti' => $kuota_cuti,
            'kuota_cuti_setelahnya' => $kuota_cuti
        );

        $query = $this->ModelKaryawan->tambah($karyawan);
        redirect(base_url('Admin/karyawan?insert=true'));
    }
    function ubah(){
        $id_user = $_POST['id_karyawan'];
        $nama = $_POST['nama'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $tanggal_masuk = $_POST['tgl_masuk'];
        $jabatan = $_POST['jabatan'];
        $kuota_cuti = $_POST['kuota_cuti'];
        $data = array(
            'id_user' => $id_user,
            'nama' => $nama,
            'password' => $password,
            'email' => $email,
            'tanggal_masuk' => $tanggal_masuk,
            'level' => $jabatan,
            'kuota_cuti' => $kuota_cuti
        );

        $query = $this->ModelKaryawan->ubah($data,$id_user);
        redirect(base_url('admin/karyawan?update=true'));

    }

    function tambah_su(){
        $id_user = $_POST['id_karyawan'];
        $nama = $_POST['nama'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $tanggal_masuk = $_POST['tgl_masuk'];
        $jabatan = $_POST['jabatan'];
        $parseStart = explode("-",$tanggal_masuk);
        $parseEnd = explode("-",date('Y-m-d'));             
        $tahun = $parseEnd[0]-$parseStart[0];
        if($tahun >= 10){
            $kuota_cuti = 21;
        }else{
            $kuota_cuti = 12;
        } 
        $karyawan = array(
            'id_user' => $id_user,
            'nama' => $nama,
            'password' => $password,
            'email' => $email,
            'tanggal_masuk' => $tanggal_masuk,
            'level' => $jabatan,
            'kuota_cuti_sebelumnya' => $kuota_cuti,
            'kuota_cuti' => $kuota_cuti,
            'kuota_cuti_setelahnya' => $kuota_cuti
        );

        $query = $this->ModelKaryawan->tambah($karyawan);
        redirect(base_url('superadmin/karyawan?insert=true'));
    }

    function ubah_su(){
        $id_user = $_POST['id_karyawan'];
        $nama = $_POST['nama'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $tanggal_masuk = $_POST['tgl_masuk'];
        $jabatan = $_POST['jabatan'];
        $kuota_cuti = $_POST['kuota_cuti'];
        $data = array(
            'id_user' => $id_user,
            'nama' => $nama,
            'password' => $password,
            'email' => $email,
            'tanggal_masuk' => $tanggal_masuk,
            'level' => $jabatan,
            'kuota_cuti' => $kuota_cuti
        );

        $query = $this->ModelKaryawan->ubah($data,$id_user);
        redirect(base_url('superadmin/karyawan?update=true'));

    }

    function cuti(){
        $nama = $_POST['nama'];
        $leave_type = $_POST['leavetype'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $reason = $_POST['reason'];
        $employe = $_POST['employe'];
        $parseStart = explode("-",$start_date);
        if($parseStart[0]%4==0){
            $tahun = $parseStart[0]*366;
        }else{
            $tahun = $parseStart[0]*365;
        }
        if($parseStart[1]==01){
            $bulan = 0;
        }else if($parseStart[1]==02){
            $bulan = 31+28;
        }else if($parseStart[1]==03){
            $bulan = 31+28;
        }else if($parseStart[1]==03 && $parseStart[0]%4==0){
            $bulan = 31+29;
        }else if($parseStart[1]==04){
            $bulan = 31+28+31;
        }else if($parseStart[1]==04){
            $bulan = 31+28+31+30;
        }else if($parseStart[1]==06){
            $bulan = 31+28+31+30+31;
        }else if($parseStart[1]==07){
            $bulan = 31+28+31+30+31+30;
        }else if($parseStart[1]== 8){
            $bulan = 31+28+31+30+31+30+31;
        }else if($parseStart[1] == 9){
            $bulan = 31+28+31+30+31+30+31+31;
        }else if($parseStart[1]==10){
            $bulan = 31+28+31+30+31+30+31+31+30;
        }else if($parseStart[1]==11){
            $bulan = 31+28+31+30+31+30+31+31+30+31;
        }else if($parseStart[1]==12){
            $bulan = 31+28+31+30+31+30+31+31+30+31+30;
        }else if($parseStart[1]==04 && $parseStart[0]%4==0){
            $bulan = 31+28+31+1;
        }else if($parseStart[1]==05 && $parseStart[0]%4==0){
            $bulan = 31+28+31+30+1;
        }else if($parseStart[1]==06 && $parseStart[0]%4==0){
            $bulan = 31+28+31+30+31+1;
        }else if($parseStart[1]==07 && $parseStart[0]%4==0){
            $bulan = 31+28+31+30+31+30+1;
        }else if($parseStart[1]== 8 && $parseStart[0]%4==0){
            $bulan = 31+28+31+30+31+30+31+1;
        }else if($parseStart[1] == 9 && $parseStart[0]%4==0){
            $bulan = 31+28+31+30+31+30+31+31+1;
        }else if($parseStart[1]==10 && $parseStart[0]%4==0){
            $bulan = 31+28+31+30+31+30+31+31+30+1;
        }else if($parseStart[1]==11 && $parseStart[0]%4==0){
            $bulan = 31+28+31+30+31+30+31+31+30+31+1;
        }else if($parseStart[1]==12 && $parseStart[0]%4==0){
            $bulan = 31+28+31+30+31+30+31+31+30+31+30+1;
        }
        
        $start = $tahun+$bulan+$parseStart[2];
        
        $parseEnd = explode("-",$end_date);
        if($parseEnd[0]%4==0){
            $tahun1 = $parseEnd[0]*366;
        }else{
            $tahun1 = $parseEnd[0]*365;
        }
        if($parseEnd[1]==01){
            $bulan1 = 0;
        }else if($parseEnd[1]==02){
            $bulan1 = 31+28;
        }else if($parseEnd[1]==03){
            $bulan1 = 31+28;
        }else if($parseEnd[1]==03 && $parseEnd[0]%4==0){
            $bulan1 = 31+29;
        }else if($parseEnd[1]==04){
            $bulan1 = 31+28+31;
        }else if($parseEnd[1]==04){
            $bulan1 = 31+28+31+30;
        }else if($parseEnd[1]==06){
            $bulan1 = 31+28+31+30+31;
        }else if($parseEnd[1]==07){
            $bulan1 = 31+28+31+30+31+30;
        }else if($parseEnd[1]== 8){
            $bulan1 = 31+28+31+30+31+30+31;
        }else if($parseEnd[1] == 9){
            $bulan1 = 31+28+31+30+31+30+31+31;
        }else if($parseEnd[1]==10){
            $bulan1 = 31+28+31+30+31+30+31+31+30;
        }else if($parseEnd[1]==11){
            $bulan1 = 31+28+31+30+31+30+31+31+30+31;
        }else if($parseEnd[1]==12){
            $bulan1 = 31+28+31+30+31+30+31+31+30+31+30;
        }else if($parseEnd[1]==04 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+1;
        }else if($parseEnd[1]==05 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+30+1;
        }else if($parseEnd[1]==06 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+30+31+1;
        }else if($parseEnd[1]==07 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+30+31+30+1;
        }else if($parseEnd[1]== 8 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+30+31+30+31+1;
        }else if($parseEnd[1] == 9 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+30+31+30+31+31+1;
        }else if($parseEnd[1]==10 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+30+31+30+31+31+30+1;
        }else if($parseEnd[1]==11 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+30+31+30+31+31+30+31+1;
        }else if($parseEnd[1]==12 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+30+31+30+31+31+30+31+30+1;
        }

        $end = $tahun1+$bulan1+$parseEnd[2];

        $total = $end - $start + 1;

        if ($total <=1 ) {
            redirect('staff/cuti');
        } else {
        
        $data = array(
            'nama' => $nama,
            'leave_type' => $leave_type,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'total' => $total,
            'reason' => $reason,
            'status' => $employe,
            'rekam' => date('Y-m-d')
         );

        $query = $this->ModelCuti->insert($data);
        $dummy = $this->db->query("SELECT kuota_cuti,kuota_cuti_setelahnya FROM karyawan WHERE nama = '$nama'")->row(); 
        $change = $dummy->kuota_cuti-$total;
            if ($change < 0) {
                $this->db->query("UPDATE karyawan SET kuota_cuti= 0,kuota_cuti_setelahnya= $dummy->kuota_cuti_setelahnya+$change WHERE nama='$nama' ");
                redirect(base_url('Staff/riwayat')); 
            } else {
                $this->db->query("UPDATE karyawan SET kuota_cuti= $dummy->kuota_cuti-$total WHERE nama='$nama' ");
                redirect(base_url('Staff/riwayat'));   
            }       
        }
    }

    function cuti_manager(){
        $nama = $_POST['nama'];
        $employe = $_POST['employe'];
        $leave_type = $_POST['leavetype'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $reason = $_POST['reason'];
        $parseStart = explode("-",$start_date);
        if($parseStart[0]%4==0){
            $tahun = $parseStart[0]*366;
        }else{
            $tahun = $parseStart[0]*365;
        }
        if($parseStart[1]==01){
            $bulan = 0;
        }else if($parseStart[1]==02){
            $bulan = 31+28;
        }else if($parseStart[1]==03){
            $bulan = 31+28;
        }else if($parseStart[1]==03 && $parseStart[0]%4==0){
            $bulan = 31+29;
        }else if($parseStart[1]==04){
            $bulan = 31+28+31;
        }else if($parseStart[1]==04){
            $bulan = 31+28+31+30;
        }else if($parseStart[1]==06){
            $bulan = 31+28+31+30+31;
        }else if($parseStart[1]==07){
            $bulan = 31+28+31+30+31+30;
        }else if($parseStart[1]== 8){
            $bulan = 31+28+31+30+31+30+31;
        }else if($parseStart[1] == 9){
            $bulan = 31+28+31+30+31+30+31+31;
        }else if($parseStart[1]==10){
            $bulan = 31+28+31+30+31+30+31+31+30;
        }else if($parseStart[1]==11){
            $bulan = 31+28+31+30+31+30+31+31+30+31;
        }else if($parseStart[1]==12){
            $bulan = 31+28+31+30+31+30+31+31+30+31+30;
        }else if($parseStart[1]==04 && $parseStart[0]%4==0){
            $bulan = 31+28+31+1;
        }else if($parseStart[1]==05 && $parseStart[0]%4==0){
            $bulan = 31+28+31+30+1;
        }else if($parseStart[1]==06 && $parseStart[0]%4==0){
            $bulan = 31+28+31+30+31+1;
        }else if($parseStart[1]==07 && $parseStart[0]%4==0){
            $bulan = 31+28+31+30+31+30+1;
        }else if($parseStart[1]== 8 && $parseStart[0]%4==0){
            $bulan = 31+28+31+30+31+30+31+1;
        }else if($parseStart[1] == 9 && $parseStart[0]%4==0){
            $bulan = 31+28+31+30+31+30+31+31+1;
        }else if($parseStart[1]==10 && $parseStart[0]%4==0){
            $bulan = 31+28+31+30+31+30+31+31+30+1;
        }else if($parseStart[1]==11 && $parseStart[0]%4==0){
            $bulan = 31+28+31+30+31+30+31+31+30+31+1;
        }else if($parseStart[1]==12 && $parseStart[0]%4==0){
            $bulan = 31+28+31+30+31+30+31+31+30+31+30+1;
        }
        
        $start = $tahun+$bulan+$parseStart[2];
        
        $parseEnd = explode("-",$end_date);
        if($parseEnd[0]%4==0){
            $tahun1 = $parseEnd[0]*366;
        }else{
            $tahun1 = $parseEnd[0]*365;
        }
        if($parseEnd[1]==01){
            $bulan1 = 0;
        }else if($parseEnd[1]==02){
            $bulan1 = 31+28;
        }else if($parseEnd[1]==03){
            $bulan1 = 31+28;
        }else if($parseEnd[1]==03 && $parseEnd[0]%4==0){
            $bulan1 = 31+29;
        }else if($parseEnd[1]==04){
            $bulan1 = 31+28+31;
        }else if($parseEnd[1]==04){
            $bulan1 = 31+28+31+30;
        }else if($parseEnd[1]==06){
            $bulan1 = 31+28+31+30+31;
        }else if($parseEnd[1]==07){
            $bulan1 = 31+28+31+30+31+30;
        }else if($parseEnd[1]== 8){
            $bulan1 = 31+28+31+30+31+30+31;
        }else if($parseEnd[1] == 9){
            $bulan1 = 31+28+31+30+31+30+31+31;
        }else if($parseEnd[1]==10){
            $bulan1 = 31+28+31+30+31+30+31+31+30;
        }else if($parseEnd[1]==11){
            $bulan1 = 31+28+31+30+31+30+31+31+30+31;
        }else if($parseEnd[1]==12){
            $bulan1 = 31+28+31+30+31+30+31+31+30+31+30;
        }else if($parseEnd[1]==04 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+1;
        }else if($parseEnd[1]==05 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+30+1;
        }else if($parseEnd[1]==06 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+30+31+1;
        }else if($parseEnd[1]==07 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+30+31+30+1;
        }else if($parseEnd[1]== 8 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+30+31+30+31+1;
        }else if($parseEnd[1] == 9 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+30+31+30+31+31+1;
        }else if($parseEnd[1]==10 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+30+31+30+31+31+30+1;
        }else if($parseEnd[1]==11 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+30+31+30+31+31+30+31+1;
        }else if($parseEnd[1]==12 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+30+31+30+31+31+30+31+30+1;
        }

        $end = $tahun1+$bulan1+$parseEnd[2];

        $total = $end - $start + 1;

        if ($total <=1 ) {
            redirect('staff/cuti');
        } else {
        
        $data = array(
            'nama' => $nama,
            'leave_type' => $leave_type,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'total' => $total,
            'reason' => $reason,
            'status' => $employe,
            'rekam' => date('Y-m-d')
         );

        $query = $this->ModelCuti->insert($data);
        $dummy = $this->db->query("SELECT kuota_cuti FROM karyawan WHERE nama = '$nama'")->row(); 
        $change = $dummy->kuota_cuti-$total;
            if ($change < 0) {
                $this->db->query("UPDATE karyawan SET kuota_cuti= 0 , kuota_cuti_setelahnya= $dummy->kuota_cuti_setelahnya + $change WHERE nama='$nama' ");
                redirect(base_url('manager/riwayat')); 
            } else {
                $this->db->query("UPDATE karyawan SET kuota_cuti= $dummy->kuota_cuti-$total WHERE nama='$nama' ");
                redirect(base_url('manager/riwayat'));   
            }       
        }
    }

    function cuti_hrd(){
        $nama = $_POST['nama'];
        $leave_type = $_POST['leavetype'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $reason = $_POST['reason'];
        $parseStart = explode("-",$start_date);
        if($parseStart[0]%4==0){
            $tahun = $parseStart[0]*366;
        }else{
            $tahun = $parseStart[0]*365;
        }
        if($parseStart[1]==01){
            $bulan = 0;
        }else if($parseStart[1]==02){
            $bulan = 31+28;
        }else if($parseStart[1]==03){
            $bulan = 31+28;
        }else if($parseStart[1]==03 && $parseStart[0]%4==0){
            $bulan = 31+29;
        }else if($parseStart[1]==04){
            $bulan = 31+28+31;
        }else if($parseStart[1]==04){
            $bulan = 31+28+31+30;
        }else if($parseStart[1]==06){
            $bulan = 31+28+31+30+31;
        }else if($parseStart[1]==07){
            $bulan = 31+28+31+30+31+30;
        }else if($parseStart[1]== 8){
            $bulan = 31+28+31+30+31+30+31;
        }else if($parseStart[1] == 9){
            $bulan = 31+28+31+30+31+30+31+31;
        }else if($parseStart[1]==10){
            $bulan = 31+28+31+30+31+30+31+31+30;
        }else if($parseStart[1]==11){
            $bulan = 31+28+31+30+31+30+31+31+30+31;
        }else if($parseStart[1]==12){
            $bulan = 31+28+31+30+31+30+31+31+30+31+30;
        }else if($parseStart[1]==04 && $parseStart[0]%4==0){
            $bulan = 31+28+31+1;
        }else if($parseStart[1]==05 && $parseStart[0]%4==0){
            $bulan = 31+28+31+30+1;
        }else if($parseStart[1]==06 && $parseStart[0]%4==0){
            $bulan = 31+28+31+30+31+1;
        }else if($parseStart[1]==07 && $parseStart[0]%4==0){
            $bulan = 31+28+31+30+31+30+1;
        }else if($parseStart[1]== 8 && $parseStart[0]%4==0){
            $bulan = 31+28+31+30+31+30+31+1;
        }else if($parseStart[1] == 9 && $parseStart[0]%4==0){
            $bulan = 31+28+31+30+31+30+31+31+1;
        }else if($parseStart[1]==10 && $parseStart[0]%4==0){
            $bulan = 31+28+31+30+31+30+31+31+30+1;
        }else if($parseStart[1]==11 && $parseStart[0]%4==0){
            $bulan = 31+28+31+30+31+30+31+31+30+31+1;
        }else if($parseStart[1]==12 && $parseStart[0]%4==0){
            $bulan = 31+28+31+30+31+30+31+31+30+31+30+1;
        }
        
        $start = $tahun+$bulan+$parseStart[2];
        
        $parseEnd = explode("-",$end_date);
        if($parseEnd[0]%4==0){
            $tahun1 = $parseEnd[0]*366;
        }else{
            $tahun1 = $parseEnd[0]*365;
        }
        if($parseEnd[1]==01){
            $bulan1 = 0;
        }else if($parseEnd[1]==02){
            $bulan1 = 31+28;
        }else if($parseEnd[1]==03){
            $bulan1 = 31+28;
        }else if($parseEnd[1]==03 && $parseEnd[0]%4==0){
            $bulan1 = 31+29;
        }else if($parseEnd[1]==04){
            $bulan1 = 31+28+31;
        }else if($parseEnd[1]==04){
            $bulan1 = 31+28+31+30;
        }else if($parseEnd[1]==06){
            $bulan1 = 31+28+31+30+31;
        }else if($parseEnd[1]==07){
            $bulan1 = 31+28+31+30+31+30;
        }else if($parseEnd[1]== 8){
            $bulan1 = 31+28+31+30+31+30+31;
        }else if($parseEnd[1] == 9){
            $bulan1 = 31+28+31+30+31+30+31+31;
        }else if($parseEnd[1]==10){
            $bulan1 = 31+28+31+30+31+30+31+31+30;
        }else if($parseEnd[1]==11){
            $bulan1 = 31+28+31+30+31+30+31+31+30+31;
        }else if($parseEnd[1]==12){
            $bulan1 = 31+28+31+30+31+30+31+31+30+31+30;
        }else if($parseEnd[1]==04 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+1;
        }else if($parseEnd[1]==05 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+30+1;
        }else if($parseEnd[1]==06 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+30+31+1;
        }else if($parseEnd[1]==07 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+30+31+30+1;
        }else if($parseEnd[1]== 8 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+30+31+30+31+1;
        }else if($parseEnd[1] == 9 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+30+31+30+31+31+1;
        }else if($parseEnd[1]==10 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+30+31+30+31+31+30+1;
        }else if($parseEnd[1]==11 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+30+31+30+31+31+30+31+1;
        }else if($parseEnd[1]==12 && $parseEnd[0]%4==0){
            $bulan1 = 31+28+31+30+31+30+31+31+30+31+30+1;
        }

        $end = $tahun1+$bulan1+$parseEnd[2];

        $total = $end - $start + 1;

        if ($total <=1 ) {
            redirect('staff/cuti');
        } else {
        
        $data = array(
            'nama' => $nama,
            'leave_type' => $leave_type,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'total' => $total,
            'reason' => $reason,
            'status' => 'h',
            'rekam' => date('Y-m-d')
         );

        $query = $this->ModelCuti->insert($data);
        $dummy = $this->db->query("SELECT kuota_cuti FROM karyawan WHERE nama = '$nama'")->row(); 
        $change = $dummy->kuota_cuti-$total;
            if ($change < 0) {
                $this->db->query("UPDATE karyawan SET kuota_cuti= 0 , kuota_cuti_setelahnya= $dummy->kuota_cuti_setelahnya + $change WHERE nama='$nama' ");
                redirect(base_url('manager/riwayat')); 
            } else {
                $this->db->query("UPDATE karyawan SET kuota_cuti= $dummy->kuota_cuti-$total WHERE nama='$nama' ");
                redirect(base_url('manager/riwayat'));   
            }       
        }
    }
}