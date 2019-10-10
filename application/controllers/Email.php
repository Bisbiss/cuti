<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('ModelKaryawan');
        $this->load->model('ModelCuti');
    }

    function index($id_cuti){
        $cuti = $this->ModelCuti->get_cuti($id_cuti)->row();
        $nama = $cuti->nama;
        $data = $this->ModelKaryawan->get_karyawan($nama)->row();
        $dataManager = $this->db->query("SELECT email FROM karyawan WHERE nama ='$data->employe_manager'")->row();
        $where = $data->nama;
        $employe = $data->employe_manager;
        // $dataKaryawan = $this->ModelCuti->get_Where($where)->row();
        // echo $employe;
        // echo $dataManager->email;
        // echo $dataKaryawan->start_date;
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'arsip.media2@gmail.com',    // Ganti dengan email gmail kamu
            'smtp_pass' => 'projectperpus',      // Password gmail kamu
            'smtp_port' => 465,
            'crlf'      => "\r\n",
            'newline'   => "\r\n"
        ];
        // Load library email dan konfigurasinya
        $this->load->library('email', $config);
        // Email dan nama pengirim
        $this->email->from('no-reply@Cuti', 'Notifikasi E-Cuti');
        // Email penerima
        $this->email->to($dataManager->email); // Ganti dengan email tujuan kamu
        // Lampiran email, isi dengan url/path file
        $this->email->attach('');
        // Subject email
        $this->email->subject("Notifikasi Pengajuan Cuti");
        // Isi email
        $this->email->message("karyawan dengan nama ".$where." mengajukan cuti tanggal ".$cuti->start_date."  silahkan konfirmasi di system E-Cuti");
        if ($this->email->send()) {
            // echo "Emaill Terkirim";
            $this->db->query("UPDATE cuti SET status='$employe' WHERE id_cuti='$id_cuti'");
            redirect(base_url('email/send_hrd/'.$nama));
        }else{
            // echo "Emaill Gagal Terkirim";
            $this->db->query("UPDATE cuti SET status='$employe' WHERE id_cuti='$id_cuti'");
            redirect(base_url('email/send_hrd/'.$nama));            
        }
    }

    function send_hrd($nama){
        $data = $this->ModelKaryawan->get_karyawan($nama)->row();
        $dataManager = $this->db->query("SELECT email FROM karyawan WHERE level =3")->row();
        $where = $data->nama;
        $dataKaryawan = $this->ModelCuti->get_Where($where)->row();
        // echo $where;
        // echo $dataManager->email;
        // echo $dataKaryawan->start_date;
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'arsip.media2@gmail.com',    // Ganti dengan email gmail kamu
            'smtp_pass' => 'projectperpus',      // Password gmail kamu
            'smtp_port' => 465,
            'crlf'      => "\r\n",
            'newline'   => "\r\n"
        ];
        // Load library email dan konfigurasinya
        $this->load->library('email', $config);
        // Email dan nama pengirim
        $this->email->from('no-reply@Cuti', 'Notifikasi E-Cuti');
        // Email penerima
        $this->email->to($dataManager->email); // Ganti dengan email tujuan kamu
        // Lampiran email, isi dengan url/path file
        $this->email->attach('');
        // Subject email
        $this->email->subject("Notifikasi Pengajuan Cuti");
        // Isi email
        $this->email->message("karyawan dengan nama ".$where." mengajukan cuti tanggal ".$dataKaryawan->start_date."  silahkan konfirmasi di system E-Cuti");
        if ($this->email->send()) {
            // echo "Emaill Terkirim";
            redirect(base_url('email/send_admin/'.$nama));
        }else{
            // echo "Emaill Gagal Terkirim";
            redirect(base_url('email/send_admin/'.$nama));            
        }
    }
    function send_admin($nama){
        $data = $this->ModelKaryawan->get_karyawan($nama)->row();
        $dataManager = $this->db->query("SELECT email FROM karyawan WHERE level =4")->row();
        $where = $data->nama;
        $dataKaryawan = $this->ModelCuti->get_Where($where)->row();
        // echo $where;
        // echo $dataManager->email;
        // echo $dataKaryawan->start_date;
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'arsip.media2@gmail.com',    // Ganti dengan email gmail kamu
            'smtp_pass' => 'projectperpus',      // Password gmail kamu
            'smtp_port' => 465,
            'crlf'      => "\r\n",
            'newline'   => "\r\n"
        ];
        // Load library email dan konfigurasinya
        $this->load->library('email', $config);
        // Email dan nama pengirim
        $this->email->from('no-reply@Cuti', 'Notifikasi E-Cuti');
        // Email penerima
        $this->email->to($dataManager->email); // Ganti dengan email tujuan kamu
        // Lampiran email, isi dengan url/path file
        $this->email->attach('');
        // Subject email
        $this->email->subject("Notifikasi Pengajuan Cuti");
        // Isi email
        $this->email->message("karyawan dengan nama ".$where." mengajukan cuti tanggal ".$dataKaryawan->start_date."  silahkan konfirmasi di system E-Cuti");
        if ($this->email->send()) {
            // echo "Emaill Terkirim";
            redirect(base_url('email/send_super/'.$nama));
        }else{
            // echo "Emaill Gagal Terkirim";
            redirect(base_url('email/send_super/'.$nama));            
        }
    }
    function send_super($nama){
        $data = $this->ModelKaryawan->get_karyawan($nama)->row();
        $dataManager = $this->db->query("SELECT email FROM karyawan WHERE level =4")->row();
        $where = $data->nama;
        $dataKaryawan = $this->ModelCuti->get_Where($where)->row();
        // echo $where;
        // echo $dataManager->email;
        // echo $dataKaryawan->start_date;
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'arsip.media2@gmail.com',    // Ganti dengan email gmail kamu
            'smtp_pass' => 'projectperpus',      // Password gmail kamu
            'smtp_port' => 465,
            'crlf'      => "\r\n",
            'newline'   => "\r\n"
        ];
        // Load library email dan konfigurasinya
        $this->load->library('email', $config);
        // Email dan nama pengirim
        $this->email->from('no-reply@Cuti', 'Notifikasi E-Cuti');
        // Email penerima
        $this->email->to($dataManager->email); // Ganti dengan email tujuan kamu
        // Lampiran email, isi dengan url/path file
        $this->email->attach('');
        // Subject email
        $this->email->subject("Notifikasi Pengajuan Cuti");
        // Isi email
        $this->email->message("karyawan dengan nama ".$where." mengajukan cuti tanggal ".$dataKaryawan->start_date."  silahkan konfirmasi di system E-Cuti");
        if ($this->email->send()) {
            // echo "Emaill Terkirim";
            redirect(base_url('staff/riwayat'));
        }else{
            // echo "Emaill Gagal Terkirim";
            redirect(base_url('staff/riwayat'));            
        }
    }
    
}