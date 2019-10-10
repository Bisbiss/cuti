<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('ModelKaryawan');
        $this->load->model('ModelCuti');
    }

    function index($nama){
        $data = $this->ModelKaryawan->get_karyawan($nama)->row();
        $dataManager = $this->db->query("SELECT email FROM karyawan WHERE nama ='$data->employe_manager'")->row();
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
            redirect(base_url('email/send_hrd/'.$nama));
        }else{
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
            redirect(base_url('email/send_admin/'.$nama));
        }else{
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
            redirect(base_url('email/send_super/'.$nama));
        }else{
            redirect(base_url('email/send_super/'.$nama));            
        }
    }

    function send_super($nama){
        $data = $this->ModelKaryawan->get_karyawan($nama)->row();
        $dataManager = $this->db->query("SELECT email FROM karyawan WHERE level =5")->row();
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
            redirect(base_url('Staff/riwayat'));
        }else{
            redirect(base_url('Staff/riwayat'));            
        }
    }

    function index_manager($nama){
        $data = $this->ModelKaryawan->get_karyawan($nama)->row();
        $dataManager = $this->db->query("SELECT email FROM karyawan WHERE nama ='$data->employe_manager'")->row();
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
            redirect(base_url('Email/send_hrd_manager'));
        }else{
            redirect(base_url('Email/send_hrd_manager'));            
        }
    }

    function send_hrd_manager($nama){
        $data = $this->ModelKaryawan->get_karyawan($nama)->row();
        $dataManager = $this->db->query("SELECT email FROM karyawan WHERE status =3")->row();
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
            redirect(base_url('Email/send_admin_manager'));
        }else{
            redirect(base_url('Email/send_admin_manager'));            
        }
    }

    function send_admin_manager($nama){
        $data = $this->ModelKaryawan->get_karyawan($nama)->row();
        $dataManager = $this->db->query("SELECT email FROM karyawan WHERE status =4")->row();
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
            redirect(base_url('Email/send_super_manager'));
        }else{
            redirect(base_url('Email/send_super_manager'));            
        }
    }

    function send_super_manager($nama){
        $data = $this->ModelKaryawan->get_karyawan($nama)->row();
        $dataManager = $this->db->query("SELECT email FROM karyawan WHERE status =5")->row();
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
            redirect(base_url('Manager/riwayat'));
        }else{
            redirect(base_url('Manager/riwayat'));            
        }
    }
}