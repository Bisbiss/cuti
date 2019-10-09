<?php

class ModelAkun extends CI_Model{
    public function login($id,$password)
    {
        $this->db->where('id_user',$id);
        $this->db->where('password', $password);
        return $this->db->get('karyawan');
    }
}