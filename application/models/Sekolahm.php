<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sekolahm
 *
 * @author RIFANI
 */
class Sekolahm extends CI_Model {

    function login($username, $password) {
        $query = $this->db->query("select * from tb_user where username='$username' and password='$password'");
        return$query;
    }

    function datam() {
        $datam = $this->db->query("select * from tb_murid");
        return$datam;
    }

    function delete_murid($id_murid) {
        $this->db->where('id_murid', $id_murid);
        $this->db->delete('tb_murid');
        return $this->db->affected_rows();
    }
//id_murid utama yg di edit
    function edit_murid($id_murid, $nama_murid, $jk, $kelas, $alamat) {
        $data = array(
            'nama_murid' => $nama_murid,
            'jk' => $jk,
            'kelas' => $kelas,
            'alamat' => $alamat,
        );
        $this->db->where('id_murid', $id_murid);
        $this->db->update('tb_murid', $data);
        return $this->db->affected_rows();
    }
 function tambah_murid($id_murid, $nama_murid, $jk, $kelas, $alamat) {
        $data = array(
            'id_murid'=>$id_murid,
            'nama_murid' => $nama_murid,
            'jk' => $jk,
            'kelas' => $kelas,
            'alamat' => $alamat,
        );
        $this->db->insert('tb_murid', $data);
        return $this->db->affected_rows();
    }
    function insert_poto($tb_murid,$data){
        $this->db->insert($tb_murid, $data);
        return $this->db->affected_rows();
        
    }
    
  
    
}

//disesuaikan table database

    
    //disesuaikan table database

