<?php

class ModelKaryawan extends CI_Model{
    public function get()
    {
        $this->db->where('level !=', 5);
        return $this->db->get('karyawan');
    }
    public function get_hrd()
    {
        $this->db->where('level !=', 5);
        $this->db->where('level !=', 4);
        return $this->db->get('karyawan');
    }
    public function get_all()
    {
        return $this->db->get('karyawan');
    }

    public function tambah($karyawan){
        $this->db->insert('karyawan', $karyawan);
    }

    function hapus($id_user){
        $this->db->where('id_user',$id_user);
        $this->db->delete('karyawan');
    }

    public function get_akun()
    {
        return $this->db->get('karyawan');
    }

    public function get_karyawan($nama)
    {
        $this->db->where('nama',$nama);
        return $this->db->get('karyawan');
    }
    public function get_edit($id_user)
    {
        $this->db->where('id_user',$id_user);
        return $this->db->get('karyawan');
    }

    function ubah($data,$id_user){
        $this->db->where('id_user',$id_user);
        $this->db->update('karyawan',$data);
    }

}