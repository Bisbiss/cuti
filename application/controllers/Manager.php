<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller {
	function __construct(){
        parent::__construct();	
        $this->load->library('session');	
        $this->load->model('ModelKaryawan');
        $this->load->model('ModelCuti');
        if ($this->session->userdata('status')!='manager') {
            redirect('welcome');
        }
    }
    
    function index(){
        $data['data'] = $this->ModelKaryawan->get_karyawan($this->session->userdata('nama'))->result();
        $this->load->view('template/head');
        $this->load->view('manager/menu');
        $this->load->view('manager/home',$data);
        $this->load->view('template/foot');
    }
    function cuti(){
        $data['data'] = $this->ModelKaryawan->get_karyawan($this->session->userdata('nama'))->result();
        $this->load->view('template/head');
        $this->load->view('manager/menu');
        $this->load->view('manager/cuti',$data);
        $this->load->view('template/foot');
    }
    function pengajuan(){
        $nama = $this->session->userdata('nama');
        $data['data'] = $this->ModelCuti->get_approve($nama)->result();
        $this->load->view('template/head');
        $this->load->view('manager/menu');
        $this->load->view('manager/pengajuan',$data);
        $this->load->view('template/foot');
    }
    function riwayat(){
        $data['data'] = $this->ModelCuti->get_where($this->session->userdata('nama'))->result();
        $this->load->view('template/head');
        $this->load->view('manager/menu',$data);
        $this->load->view('manager/riwayat');
        $this->load->view('template/foot');
    }
    function approve($id_cuti){
        $this->ModelCuti->approve($id_cuti);
        redirect('manager/pengajuan');
    }
    function disapprove($id_cuti,$total){
        $nama = $this->db->query("SELECT nama,total FROM cuti WHERE id_cuti='$id_cuti'")->row();
        $namaa = $nama->nama;
        $id_karyawan = $this->db->query("SELECT id_user,kuota_cuti,kuota_cuti_setelahnya FROM karyawan WHERE nama='$namaa'")->row();
        // var_dump($id_karyawan);
        $idd = $id_karyawan->id_user;
        $back = $id_karyawan->kuota_cuti + $total;
        // echo $back;
        if($id_karyawan->kuota_cuti_setelahnya < 12 ){
            $this->ModelCuti->disapprove($id_cuti,$idd,$back);
            redirect('manager/pengajuan');
        }else{
            $this->ModelCuti->disapprove($id_cuti,$idd,$back);
            redirect('manager/pengajuan');
        }
    }
} 