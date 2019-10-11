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
            'smtp_user' => 'bisbiss.2019@gmail.com',    // Ganti dengan email gmail kamu
            'smtp_pass' => 'r3s0lus1b4ru',      // Password gmail kamu
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
        
        // Subject email
        $this->email->subject("Notifikasi Pengajuan Cuti");
        // Isi email
        $this->email->message("karyawan dengan nama ".$where." mengajukan cuti tanggal ".$cuti->start_date."  silahkan konfirmasi di system E-Cuti");
        if ($this->email->send()) {
            // echo "Emaill Terkirim";
            $this->db->query("UPDATE cuti SET status='$employe' WHERE id_cuti='$id_cuti'");
            redirect(base_url('email/send_me/'.$id_cuti));
        }else{
            show_error($this->email->print_debugger());
            // $this->db->query("UPDATE cuti SET status='$employe' WHERE id_cuti='$id_cuti'");
            // redirect(base_url('email/send_hrd/'.$nama));            
        }
    }
    function send_me($id_cuti){
        $cuti = $this->ModelCuti->get_cuti($id_cuti)->row();
        $nama = $cuti->nama;
        $data = $this->ModelKaryawan->get_karyawan($nama)->row();
        $where = $data->email;
        $employe = $data->employe_manager;
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'bisbiss.2019@gmail.com',    // Ganti dengan email gmail kamu
            'smtp_pass' => 'r3s0lus1b4ru',      // Password gmail kamu
            'smtp_port' => 465,
            'crlf'      => "\r\n",
            'newline'   => "\r\n"
        ];
        // Load library email dan konfigurasinya
        $this->load->library('email', $config);
        // Email dan nama pengirim
        $this->email->from('no-reply@Cuti', 'Notifikasi E-Cuti');
        // Email penerima
        $this->email->to($where); // Ganti dengan email tujuan kamu
        
        // Subject email
        $this->email->subject("Notifikasi Pengajuan Cuti");
        // Isi email
        $this->email->message("Pengajuan cuti atas nama ".$data->nama." cuti tanggal ".$cuti->start_date." sampai ".$cuti->end_date." Berhasil <br> Silahkan cek di system E-Cuti");
        if ($this->email->send()) {
            // echo "Emaill Terkirim";
            // $this->db->query("UPDATE cuti SET status='$employe' WHERE id_cuti='$id_cuti'");
            redirect(base_url('email/send_hrd/'.$id_cuti));
        }else{
            show_error($this->email->print_debugger());
            // $this->db->query("UPDATE cuti SET status='$employe' WHERE id_cuti='$id_cuti'");
            // redirect(base_url('email/send_hrd/'.$nama));            
        }
    }
    function send_hrd($id_cuti){
        $cuti = $this->ModelCuti->get_cuti($id_cuti)->row();
        $nama = $cuti->nama;
        $data = $this->ModelKaryawan->get_karyawan($nama)->row();
        $dataManager = $this->db->query("SELECT email FROM karyawan WHERE level ='3'")->row();
        $where = $data->nama;
        $employe = $data->employe_manager;
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'bisbiss.2019@gmail.com',    // Ganti dengan email gmail kamu
            'smtp_pass' => 'r3s0lus1b4ru',      // Password gmail kamu
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
            redirect(base_url('staff/riwayat'));
        }else{
            // echo "Emaill Gagal Terkirim";
            redirect(base_url('staff/riwayat'));            
        }
    }
    
    
    
    // Untuk Manager
    function sending($id_cuti){
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
            'smtp_user' => 'bisbiss.2019@gmail.com',    // Ganti dengan email gmail kamu
            'smtp_pass' => 'r3s0lus1b4ru',      // Password gmail kamu
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
        
        // Subject email
        $this->email->subject("Notifikasi Pengajuan Cuti");
        // Isi email
        $this->email->message("karyawan dengan nama ".$where." mengajukan cuti tanggal ".$cuti->start_date."  silahkan konfirmasi di system E-Cuti");
        if ($this->email->send()) {
            // echo "Emaill Terkirim";
            $this->db->query("UPDATE cuti SET status='$employe' WHERE id_cuti='$id_cuti'");
            redirect(base_url('email/sending_me/'.$id_cuti));
        }else{
            show_error($this->email->print_debugger());
            // $this->db->query("UPDATE cuti SET status='$employe' WHERE id_cuti='$id_cuti'");
            // redirect(base_url('email/send_hrd/'.$nama));            
        }
    }
    function sending_me($id_cuti){
        $cuti = $this->ModelCuti->get_cuti($id_cuti)->row();
        $nama = $cuti->nama;
        $data = $this->ModelKaryawan->get_karyawan($nama)->row();
        $where = $data->email;
        $employe = $data->employe_manager;
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'bisbiss.2019@gmail.com',    // Ganti dengan email gmail kamu
            'smtp_pass' => 'r3s0lus1b4ru',      // Password gmail kamu
            'smtp_port' => 465,
            'crlf'      => "\r\n",
            'newline'   => "\r\n"
        ];
        // Load library email dan konfigurasinya
        $this->load->library('email', $config);
        // Email dan nama pengirim
        $this->email->from('no-reply@Cuti', 'Notifikasi E-Cuti');
        // Email penerima
        $this->email->to($where); // Ganti dengan email tujuan kamu
        
        // Subject email
        $this->email->subject("Notifikasi Pengajuan Cuti");
        // Isi email
        $this->email->message("Pengajuan cuti atas nama ".$data->nama." cuti tanggal ".$cuti->start_date." sampai ".$cuti->end_date." Berhasil <br> Silahkan cek di system E-Cuti");
        if ($this->email->send()) {
            // echo "Emaill Terkirim";
            // $this->db->query("UPDATE cuti SET status='$employe' WHERE id_cuti='$id_cuti'");
            redirect(base_url('email/sending_hrd/'.$id_cuti));
        }else{
            show_error($this->email->print_debugger());
            // $this->db->query("UPDATE cuti SET status='$employe' WHERE id_cuti='$id_cuti'");
            // redirect(base_url('email/send_hrd/'.$nama));            
        }
    }
    function sending_hrd($id_cuti){
        $cuti = $this->ModelCuti->get_cuti($id_cuti)->row();
        $nama = $cuti->nama;
        $data = $this->ModelKaryawan->get_karyawan($nama)->row();
        $dataManager = $this->db->query("SELECT email FROM karyawan WHERE level ='3'")->row();
        $where = $data->nama;
        $employe = $data->employe_manager;
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'bisbiss.2019@gmail.com',    // Ganti dengan email gmail kamu
            'smtp_pass' => 'r3s0lus1b4ru',      // Password gmail kamu
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
            redirect(base_url('manager/riwayat'));
        }else{
            // echo "Emaill Gagal Terkirim";
            redirect(base_url('manager/riwayat'));            
        }
    }
    
    // Approve
    function approve($id_cuti){
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
            'smtp_user' => 'bisbiss.2019@gmail.com',    // Ganti dengan email gmail kamu
            'smtp_pass' => 'r3s0lus1b4ru',      // Password gmail kamu
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
        
        // Subject email
        $this->email->subject("Pemberitahuan Pengajuan Cuti");
        // Isi email
        $this->email->message("Cuti atas nama ".$where." sudah di approve");
        if ($this->email->send()) {
            // echo "Emaill Terkirim";
            // $this->db->query("UPDATE cuti SET status='$employe' WHERE id_cuti='$id_cuti'");
            redirect(base_url('email/approve_me/'.$id_cuti));
        }else{
            show_error($this->email->print_debugger());
            // $this->db->query("UPDATE cuti SET status='$employe' WHERE id_cuti='$id_cuti'");
            // redirect(base_url('email/send_hrd/'.$nama));            
        }
    }
    function approve_me($id_cuti){
        $cuti = $this->ModelCuti->get_cuti($id_cuti)->row();
        $nama = $cuti->nama;
        $data = $this->ModelKaryawan->get_karyawan($nama)->row();
        $where = $data->email;
        $employe = $data->employe_manager;
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'bisbiss.2019@gmail.com',    // Ganti dengan email gmail kamu
            'smtp_pass' => 'r3s0lus1b4ru',      // Password gmail kamu
            'smtp_port' => 465,
            'crlf'      => "\r\n",
            'newline'   => "\r\n"
        ];
        // Load library email dan konfigurasinya
        $this->load->library('email', $config);
        // Email dan nama pengirim
        $this->email->from('no-reply@Cuti', 'Notifikasi E-Cuti');
        // Email penerima
        $this->email->to($where); // Ganti dengan email tujuan kamu
        
        // Subject email
        $this->email->subject("Pemberitahuan Pengajuan Cuti");
        // Isi email
        $this->email->message("Selamat.. <br><br><b>Cuti anda sudah di Approve</b>");
        if ($this->email->send()) {
            // echo "Emaill Terkirim";
            // $this->db->query("UPDATE cuti SET status='$employe' WHERE id_cuti='$id_cuti'");
            redirect(base_url('email/approve_hrd/'.$id_cuti));
        }else{
            show_error($this->email->print_debugger());
            // $this->db->query("UPDATE cuti SET status='$employe' WHERE id_cuti='$id_cuti'");
            // redirect(base_url('email/send_hrd/'.$nama));            
        }
    }
    function approve_hrd($id_cuti){
        $cuti = $this->ModelCuti->get_cuti($id_cuti)->row();
        $nama = $cuti->nama;
        $data = $this->ModelKaryawan->get_karyawan($nama)->row();
        $dataManager = $this->db->query("SELECT email FROM karyawan WHERE level ='3'")->row();
        $where = $data->nama;
        $employe = $data->employe_manager;
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'bisbiss.2019@gmail.com',    // Ganti dengan email gmail kamu
            'smtp_pass' => 'r3s0lus1b4ru',      // Password gmail kamu
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
        
        // Subject email
        $this->email->subject("Pemberitahuan Pengajuan Cuti");
        // Isi email
        $this->email->message("Cuti atas nama ".$where." sudah di approve");
        if ($this->email->send()) {
            // echo "Emaill Terkirim";
            redirect(base_url('manager/pengajuan'));
        }else{
            // echo "Emaill Gagal Terkirim";
            redirect(base_url('manager/pengajuan'));            
        }
    }

    //Approve HRD
    function app($id_cuti){
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
            'smtp_user' => 'bisbiss.2019@gmail.com',    // Ganti dengan email gmail kamu
            'smtp_pass' => 'r3s0lus1b4ru',      // Password gmail kamu
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
        
        // Subject email
        $this->email->subject("Pemberitahuan Pengajuan Cuti");
        // Isi email
        $this->email->message("Cuti atas nama ".$where." sudah di approve");
        if ($this->email->send()) {
            // echo "Emaill Terkirim";
            // $this->db->query("UPDATE cuti SET status='$employe' WHERE id_cuti='$id_cuti'");
            redirect(base_url('email/app_me/'.$id_cuti));
        }else{
            show_error($this->email->print_debugger());
            // $this->db->query("UPDATE cuti SET status='$employe' WHERE id_cuti='$id_cuti'");
            // redirect(base_url('email/send_hrd/'.$nama));            
        }
    }
    function app_me($id_cuti){
        $cuti = $this->ModelCuti->get_cuti($id_cuti)->row();
        $nama = $cuti->nama;
        $data = $this->ModelKaryawan->get_karyawan($nama)->row();
        $where = $data->email;
        $employe = $data->employe_manager;
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'bisbiss.2019@gmail.com',    // Ganti dengan email gmail kamu
            'smtp_pass' => 'r3s0lus1b4ru',      // Password gmail kamu
            'smtp_port' => 465,
            'crlf'      => "\r\n",
            'newline'   => "\r\n"
        ];
        // Load library email dan konfigurasinya
        $this->load->library('email', $config);
        // Email dan nama pengirim
        $this->email->from('no-reply@Cuti', 'Notifikasi E-Cuti');
        // Email penerima
        $this->email->to($where); // Ganti dengan email tujuan kamu
        
        // Subject email
        $this->email->subject("Pemberitahuan Pengajuan Cuti");
        // Isi email
        $this->email->message("Selamat.. <br><br><b>Cuti anda sudah di Approve</b>");
        if ($this->email->send()) {
            // echo "Emaill Terkirim";
            // $this->db->query("UPDATE cuti SET status='$employe' WHERE id_cuti='$id_cuti'");
            redirect(base_url('email/app_hrd/'.$id_cuti));
        }else{
            show_error($this->email->print_debugger());
            // $this->db->query("UPDATE cuti SET status='$employe' WHERE id_cuti='$id_cuti'");
            // redirect(base_url('email/send_hrd/'.$nama));            
        }
    }
    function app_hrd($id_cuti){
        $cuti = $this->ModelCuti->get_cuti($id_cuti)->row();
        $nama = $cuti->nama;
        $data = $this->ModelKaryawan->get_karyawan($nama)->row();
        $dataManager = $this->db->query("SELECT email FROM karyawan WHERE level ='3'")->row();
        $where = $data->nama;
        $employe = $data->employe_manager;
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'bisbiss.2019@gmail.com',    // Ganti dengan email gmail kamu
            'smtp_pass' => 'r3s0lus1b4ru',      // Password gmail kamu
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
        
        // Subject email
        $this->email->subject("Pemberitahuan Pengajuan Cuti");
        // Isi email
        $this->email->message("Cuti atas nama ".$where." sudah di approve");
        if ($this->email->send()) {
            // echo "Emaill Terkirim";
            redirect(base_url('hrd/pengajuan'));
        }else{
            // echo "Emaill Gagal Terkirim";
            redirect(base_url('hrd/pengajuan'));            
        }
    }

    // Approve
    function diss($id_cuti){
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
            'smtp_user' => 'bisbiss.2019@gmail.com',    // Ganti dengan email gmail kamu
            'smtp_pass' => 'r3s0lus1b4ru',      // Password gmail kamu
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
        
        // Subject email
        $this->email->subject("Pemberitahuan Pengajuan Cuti");
        // Isi email
        $this->email->message("Cuti atas nama ".$where." tidak disetujui");
        if ($this->email->send()) {
            // echo "Emaill Terkirim";
            // $this->db->query("UPDATE cuti SET status='$employe' WHERE id_cuti='$id_cuti'");
            redirect(base_url('email/diss_me/'.$id_cuti));
        }else{
            show_error($this->email->print_debugger());
            // $this->db->query("UPDATE cuti SET status='$employe' WHERE id_cuti='$id_cuti'");
            // redirect(base_url('email/send_hrd/'.$nama));            
        }
    }
    function diss_me($id_cuti){
        $cuti = $this->ModelCuti->get_cuti($id_cuti)->row();
        $nama = $cuti->nama;
        $data = $this->ModelKaryawan->get_karyawan($nama)->row();
        $where = $data->email;
        $employe = $data->employe_manager;
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'bisbiss.2019@gmail.com',    // Ganti dengan email gmail kamu
            'smtp_pass' => 'r3s0lus1b4ru',      // Password gmail kamu
            'smtp_port' => 465,
            'crlf'      => "\r\n",
            'newline'   => "\r\n"
        ];
        // Load library email dan konfigurasinya
        $this->load->library('email', $config);
        // Email dan nama pengirim
        $this->email->from('no-reply@Cuti', 'Notifikasi E-Cuti');
        // Email penerima
        $this->email->to($where); // Ganti dengan email tujuan kamu
        
        // Subject email
        $this->email->subject("Pemberitahuan Pengajuan Cuti");
        // Isi email
        $this->email->message("Mohon Maaf <br><br><b>Cuti yang anda ajukan ditolak</b>");
        if ($this->email->send()) {
            // echo "Emaill Terkirim";
            // $this->db->query("UPDATE cuti SET status='$employe' WHERE id_cuti='$id_cuti'");
            redirect(base_url('email/diss_hrd/'.$id_cuti));
        }else{
            show_error($this->email->print_debugger());
            // $this->db->query("UPDATE cuti SET status='$employe' WHERE id_cuti='$id_cuti'");
            // redirect(base_url('email/send_hrd/'.$nama));            
        }
    }
    function diss_hrd($id_cuti){
        $cuti = $this->ModelCuti->get_cuti($id_cuti)->row();
        $nama = $cuti->nama;
        $data = $this->ModelKaryawan->get_karyawan($nama)->row();
        $dataManager = $this->db->query("SELECT email FROM karyawan WHERE level ='3'")->row();
        $where = $data->nama;
        $employe = $data->employe_manager;
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'bisbiss.2019@gmail.com',    // Ganti dengan email gmail kamu
            'smtp_pass' => 'r3s0lus1b4ru',      // Password gmail kamu
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
        
        // Subject email
        $this->email->subject("Pemberitahuan Pengajuan Cuti");
        // Isi email
        $this->email->message("Cuti atas nama ".$where." tidak disetujui");
        if ($this->email->send()) {
            // echo "Emaill Terkirim";
            redirect(base_url('manager/pengajuan'));
        }else{
            // echo "Emaill Gagal Terkirim";
            redirect(base_url('manager/pengajuan'));            
        }
    }

    //Dissapprove HRD
    function dis($id_cuti){
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
            'smtp_user' => 'bisbiss.2019@gmail.com',    // Ganti dengan email gmail kamu
            'smtp_pass' => 'r3s0lus1b4ru',      // Password gmail kamu
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
        
        // Subject email
        $this->email->subject("Pemberitahuan Pengajuan Cuti");
        // Isi email
        $this->email->message("Cuti atas nama ".$where." tidak disetujui");
        if ($this->email->send()) {
            // echo "Emaill Terkirim";
            // $this->db->query("UPDATE cuti SET status='$employe' WHERE id_cuti='$id_cuti'");
            redirect(base_url('email/dis_me/'.$id_cuti));
        }else{
            show_error($this->email->print_debugger());
            // $this->db->query("UPDATE cuti SET status='$employe' WHERE id_cuti='$id_cuti'");
            // redirect(base_url('email/send_hrd/'.$nama));            
        }
    }
    function dis_me($id_cuti){
        $cuti = $this->ModelCuti->get_cuti($id_cuti)->row();
        $nama = $cuti->nama;
        $data = $this->ModelKaryawan->get_karyawan($nama)->row();
        $where = $data->email;
        $employe = $data->employe_manager;
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'bisbiss.2019@gmail.com',    // Ganti dengan email gmail kamu
            'smtp_pass' => 'r3s0lus1b4ru',      // Password gmail kamu
            'smtp_port' => 465,
            'crlf'      => "\r\n",
            'newline'   => "\r\n"
        ];
        // Load library email dan konfigurasinya
        $this->load->library('email', $config);
        // Email dan nama pengirim
        $this->email->from('no-reply@Cuti', 'Notifikasi E-Cuti');
        // Email penerima
        $this->email->to($where); // Ganti dengan email tujuan kamu
        
        // Subject email
        $this->email->subject("Pemberitahuan Pengajuan Cuti");
        // Isi email
        $this->email->message("Mohon Maaf.. <br><br><b>Cuti yang anda ajukan ditolak</b>");
        if ($this->email->send()) {
            // echo "Emaill Terkirim";
            // $this->db->query("UPDATE cuti SET status='$employe' WHERE id_cuti='$id_cuti'");
            redirect(base_url('email/dis_hrd/'.$id_cuti));
        }else{
            show_error($this->email->print_debugger());
            // $this->db->query("UPDATE cuti SET status='$employe' WHERE id_cuti='$id_cuti'");
            // redirect(base_url('email/send_hrd/'.$nama));            
        }
    }
    function dis_hrd($id_cuti){
        $cuti = $this->ModelCuti->get_cuti($id_cuti)->row();
        $nama = $cuti->nama;
        $data = $this->ModelKaryawan->get_karyawan($nama)->row();
        $dataManager = $this->db->query("SELECT email FROM karyawan WHERE level ='3'")->row();
        $where = $data->nama;
        $employe = $data->employe_manager;
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'bisbiss.2019@gmail.com',    // Ganti dengan email gmail kamu
            'smtp_pass' => 'r3s0lus1b4ru',      // Password gmail kamu
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
        
        // Subject email
        $this->email->subject("Pemberitahuan Pengajuan Cuti");
        // Isi email
        $this->email->message("Cuti atas nama ".$where." tidak disetujui");
        if ($this->email->send()) {
            // echo "Emaill Terkirim";
            redirect(base_url('hrd/pengajuan'));
        }else{
            // echo "Emaill Gagal Terkirim";
            redirect(base_url('hrd/pengajuan'));            
        }
    }

    
}