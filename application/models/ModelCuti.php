<?php

class ModelCuti extends CI_Model{
    public function get(){
        return $this->db->get('cuti');
    }

    function insert($data){
        $this->db->insert('cuti',$data);
    }

    function get_cuti($id_cuti){
        $this->db->where('id_cuti',$id_cuti);
        return $this->db->get('cuti');
    }

    function hapus($id_cuti){
        $this->db->where('id_cuti',$id_cuti);
        $this->db->delete('cuti');
    }

    public function get_where($where){
        $this->db->where('nama',$where);
        $this->db->order_by('id_cuti', 'DESC');
        return $this->db->get('cuti');
    }
    public function get_approve($nama){
        $this->db->where('status',$nama);
        return $this->db->get('cuti');
    }
    public function get_approve_hrd(){
        $this->db->where('status !=','v');
        $this->db->where('status !=','r');
        return $this->db->get('cuti');
    }
    public function get_approve_su(){
        $this->db->order_by('id_cuti', 'DESC');
        return $this->db->get('cuti');
    }
    function approve($id_cuti){    
        $this->db->set('status', 'v');
        $this->db->where('id_cuti', $id_cuti);
        $this->db->update('cuti');
    }
    function disapprove($id_cuti,$idd,$back){    
        $this->db->set('status', 'r');
        $this->db->where('id_cuti', $id_cuti);
        $this->db->update('cuti');

        $this->db->set('kuota_cuti', $back);
        $this->db->where('id_user', $idd);
        $this->db->update('karyawan',$data);
    }
}