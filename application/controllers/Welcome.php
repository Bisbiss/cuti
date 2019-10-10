<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('ModelAkun');		
	}

	public function index()
	{
		$this->load->view('template/head');
		$this->load->view('login');
	}

	function login(){
		$id = $_POST['id'];
		$password = $_POST['password'];
		
		$query = $this->ModelAkun->login($id,$password);
		$cek = $query->num_rows();
		if ($cek < 1) {
			redirect('welcome?pesan=false');
		} else {
			$level = $query->row();
			if ($level->level == 5) {
				$ses = array(
					'nama' => $level->nama,
					'status' => 'superadmin'
				);
				$this->session->set_userdata($ses);
				redirect('superadmin');
			}else if($level->level == 4) {
				$ses = array(
					'nama' => $level->nama,
					'status' => 'admin'
				);
				$this->session->set_userdata($ses);
				redirect('admin');
			}else if($level->level == 3) {
				$ses = array(
					'nama' => $level->nama,
					'status' => 'hrd'
				);
				$this->session->set_userdata($ses);
				redirect('hrd');
			}else if($level->level == 2) {
				$ses = array(
					'nama' => $level->nama,
					'status' => 'manager',
					'rule' => $level->employe_manager
				);
				$cek = $this->db->query("SELECT * FROM cuti Where nama = '$level->nama' ")->result();
				foreach ($cek as $cek){
					// echo date('d');
					$parseStart = explode("-",$cek->rekam);
					$cekin = $parseStart[2]+3;
					// echo $level->nama;
					if(date('Y') == $parseStart[0] && date('m') == $parseStart[1] && date('d') >= $cekin){
						return $this->db->query("UPDATE cuti SET status = 'v' WHERE id_cuti = '$cek->id_cuti'");

					}
				}
				$this->session->set_userdata($ses);
				redirect('manager');
			}else{
				$ses = array(
					'nama' => $level->nama,
					'status' => 'karyawan',
					'rule' => $level->employe_manager
				);
				$cek = $this->db->query("SELECT * FROM cuti Where nama = '$level->nama' ")->result();
				foreach ($cek as $cek){
					// echo date('d');
					$parseStart = explode("-",$cek->rekam);
					$cekin = $parseStart[2]+3;
					// echo $level->nama;
					if(date('Y') == $parseStart[0] && date('m') == $parseStart[1] && date('d') >= $cekin && $cek->status != 'v'){
						return $this->db->query("UPDATE cuti SET status = 'v' WHERE id_cuti = '$cek->id_cuti'");
					}
				}
				$this->session->set_userdata($ses);
				redirect('staff');
			}
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect('welcome');
	}
}
