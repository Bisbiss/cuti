<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Superadmin extends CI_Controller {
	function __construct(){
        parent::__construct();	
        $this->load->library('session');
        $this->load->model('ModelKaryawan');
        $this->load->model('ModelCuti');
        if ($this->session->userdata('status')!='superadmin') {
            redirect('welcome');
        }
    }
    
    function index(){
        $this->load->view('template/head');
        $this->load->view('superadmin/menu');
        $this->load->view('superadmin/home');
        $this->load->view('template/foot');
    }
    function karyawan(){
        $karyawan['karyawan']= $this->ModelKaryawan->get_all()->result();
        $this->load->view('template/head');
        $this->load->view('superadmin/menu');
        $this->load->view('superadmin/karyawan',$karyawan);
        $this->load->view('template/foot');
    }
    function cetak(){
        $data['data'] = $this->ModelKaryawan->get_all()->result();
        $this->load->view('superadmin/cetak', $data);
    }
    function tambahKaryawan(){
        $this->load->view('template/head');
        $this->load->view('superadmin/menu');
        $this->load->view('superadmin/tambahkaryawan');
        $this->load->view('template/foot');
    }
    function hapus($id_user){
        $hapus = $this->ModelKaryawan->hapus($id_user);
        redirect(base_url('superadmin/karyawan?delete=true'));
    }
    function ubah($id_user){
        $data['data'] = $this->ModelKaryawan->get_edit($id_user)->result();
        $this->load->view('template/head');
        $this->load->view('superadmin/menu');
        $this->load->view('superadmin/ubahkaryawan', $data);
        $this->load->view('template/foot');
    }
    function pengajuan(){
        $data['data'] = $this->ModelCuti->get_approve_su()->result();
        $this->load->view('template/head');
        $this->load->view('superadmin/menu');
        $this->load->view('superadmin/pengajuan',$data);
        $this->load->view('template/foot');
    }
    function approve($id_cuti){
        $this->ModelCuti->approve($id_cuti);
        redirect('superadmin/pengajuan');
    }
    function disapprove($id_cuti,$total){
        $nama = $this->db->query("SELECT nama,total FROM cuti WHERE id_cuti='$id_cuti'")->row();
        $namaa = $nama->nama;
        $id_karyawan = $this->db->query("SELECT id_user,kuota_cuti FROM karyawan WHERE nama='$namaa'")->row();
        // var_dump($id_karyawan);
        $idd = $id_karyawan->id_user;
        $back = $id_karyawan->kuota_cuti + $total;
        // echo $back;
        $this->ModelCuti->disapprove($id_cuti,$idd,$back);
        redirect('superadmin/pengajuan');
    }
}