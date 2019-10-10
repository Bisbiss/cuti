<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {
	function __construct(){
        parent::__construct();	
        $this->load->model('ModelKaryawan');
        $this->load->model('ModelCuti');
        $this->load->library('session');
        if ($this->session->userdata('status')!='karyawan') {
            redirect('welcome');
        }
    }
    
    function index(){
        $data['data'] = $this->ModelKaryawan->get_karyawan($this->session->userdata('nama'))->result();
        $this->load->view('template/head');
        $this->load->view('staff/menu');
        $this->load->view('staff/home',$data);
        $this->load->view('template/foot');
    }
    function cuti(){
        $data['data'] = $this->ModelKaryawan->get_karyawan($this->session->userdata('nama'))->result();
        $this->load->view('staff/head');
        $this->load->view('staff/menu');
        $this->load->view('staff/cuti',$data);
        $this->load->view('template/foot');
    }
    function riwayat(){
        $data['data'] = $this->ModelCuti->get_where($this->session->userdata('nama'))->result();
        $this->load->view('staff/head');
        $this->load->view('staff/menu');
        $this->load->view('staff/riwayat',$data);
        $this->load->view('template/foot');
    }
    function hapus($id_cuti){
        $hapus = $this->ModelCuti->hapus($id_cuti);
        redirect(base_url('staff/riwayat'));
    }
}