<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hrd extends CI_Controller {
	function __construct(){
        parent::__construct();	
        $this->load->library('session');	
        $this->load->model('ModelKaryawan');
        $this->load->model('ModelCuti');
        if ($this->session->userdata('status')!='hrd') {
            redirect('welcome');
        }
    }
    
    function index(){
        $data['data'] = $this->ModelKaryawan->get_karyawan($this->session->userdata('nama'))->result();
        $this->load->view('template/head');
        $this->load->view('hrd/menu');
        $this->load->view('hrd/home',$data);
        $this->load->view('template/foot');
    }
    function cuti(){
        $data['data'] = $this->ModelKaryawan->get_karyawan($this->session->userdata('nama'))->result();
        $this->load->view('template/head');
        $this->load->view('hrd/menu');
        $this->load->view('hrd/cuti',$data);
        $this->load->view('template/foot');
    }
    function pengajuan(){
        $data['data'] = $this->ModelCuti->get_approve_hrd()->result();
        $this->load->view('template/head');
        $this->load->view('hrd/menu');
        $this->load->view('hrd/pengajuan',$data);
        $this->load->view('template/foot');
    }
    function riwayat(){
        $data['data'] = $this->ModelCuti->get_where($this->session->userdata('nama'))->result();
        $this->load->view('template/head');
        $this->load->view('hrd/menu',$data);
        $this->load->view('hrd/riwayat');
        $this->load->view('template/foot');
    }
    function approve($id_cuti){
        $this->ModelCuti->approve($id_cuti);
        redirect('hrd/pengajuan');
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
        redirect('hrd/pengajuan');
    }
}