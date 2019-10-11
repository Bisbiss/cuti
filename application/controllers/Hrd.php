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
    function karyawan(){
        $karyawan['karyawan']= $this->ModelKaryawan->get_hrd()->result();
        $this->load->view('template/head');
        $this->load->view('hrd/menu');
        $this->load->view('hrd/karyawan',$karyawan);
        $this->load->view('template/foot');
    }
    function tambahKaryawan(){
        $this->load->view('template/head');
        $this->load->view('hrd/menu');
        $this->load->view('hrd/tambahkaryawan');
        $this->load->view('template/foot');
    }
    function ubah($id_user){
        $data['data'] = $this->ModelKaryawan->get_edit($id_user)->result();
        $this->load->view('template/head');
        $this->load->view('hrd/menu');
        $this->load->view('hrd/ubahkaryawan', $data);
        $this->load->view('template/foot');
    }
    function hapus($id_user){
        $hapus = $this->ModelKaryawan->hapus($id_user);
        redirect(base_url('admin/karyawan?delete=true'));
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
        redirect (base_url('email/app/'.$id_cuti));
    }
    function disapprove($id_cuti,$total){
        $nama = $this->db->query("SELECT nama,total FROM cuti WHERE id_cuti='$id_cuti'")->row();
        $namaa = $nama->nama;
        $id_karyawan = $this->db->query("SELECT id_user,kuota_cuti FROM karyawan WHERE nama='$namaa'")->row();
        // var_dump($id_karyawan);
        $idd = $id_karyawan->id_user;
        $back = $id_karyawan->kuota_cuti + $total;
        // echo $back;
        if($id_karyawan->kuota_cuti_setelahnya < 12 ){
            $this->ModelCuti->disapprove($id_cuti,$idd,$back);
            redirect (base_url('email/dis/'.$id_cuti));
        }else{
            $this->ModelCuti->disapprove($id_cuti,$idd,$back);
            redirect (base_url('email/dis/'.$id_cuti));
        }
    }
}