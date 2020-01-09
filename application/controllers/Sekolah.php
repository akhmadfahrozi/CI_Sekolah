<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sekolah
 *
 * @author RIFANI
 */
class Sekolah extends CI_Controller {

    //put your code here
    function login() {
        $username = $this->input->get('username');
        $password = $this->input->get('password');
        //loadmodel
        $this->load->model('Sekolahm', NULL);
        $rest = $this->Sekolahm->login($username, $password)->result();
        foreach ($rest as $value) {
            print $value->username;
            print $value->password;
        }
    }

    function login_json() {
        $username = $this->input->get('username');
        $password = $this->input->get('password');
        //loadmodel
        $this->load->model('Sekolahm', NULL);
        $data['data'] = array();
        $rest = $this->Sekolahm->login($username, $password)->result();
        foreach ($rest as $value) {
            $json = array();
            $json['username'] = $value->username;
            $json['nama'] = $value->nama;
            array_push($data['data'], $json);
        }
        print json_encode($data);
    }

    function datam_json() {
        $this->load->model('Sekolahm', NULL);
        $data['data'] = array();
        $rest = $this->Sekolahm->datam()->result();
        foreach ($rest as $value) {
            $json = array();
            $json['id_murid'] = $value->id_murid;
            $json['nama_murid'] = $value->nama_murid;
            $json['jk'] = $value->jk;
            $json['kelas'] = $value->kelas;
            $json['alamat'] = $value->alamat;
            array_push($data['data'], $json);
        }
        print json_encode($data);
    }

    function delete_murid() {
        $this->load->model("Sekolahm", NULL);
        $id_murid = $this->input->get('id_murid');
        $a = $this->Sekolahm->delete_murid($id_murid);

        if ($a > 0) {
            $data['message'] = "Berhasil menghapus data murid";
            $data['status'] = 303;
            print json_encode($data);
        } else {
            $data['message'] = "error saat memproses data";
            $data['status'] = 500;
            print json_encode($data);
        }
    }
    function edit_murid(){
        $this->load->model("Sekolahm",NULL);
        
        $id_murid = $this->input->get('id_murid');
        $nama_murid = $this->input->get('nama_murid');
        $jk = $this->input->get('jk');
        $kelas = $this->input->get('kelas');
        $alamat = $this->input->get('alamat');
        
        $res = $this->Sekolahm->edit_murid($id_murid,$nama_murid,$jk,$kelas,$alamat);
        if ($res > 0){
            $data['message']="Berhasil mengedit data murid";
            print json_encode($data);
        }else{
            $data['message']="Error saat memproses data";
            print json_encode($data);
        }
    }
     function tambah_murid(){
        $this->load->model("Sekolahm",NULL);
        
        $id_murid = $this->input->get('id_murid');
        $nama_murid = $this->input->get('nama_murid');
        $jk = $this->input->get('jk');
        $kelas = $this->input->get('kelas');
        $alamat = $this->input->get('alamat');
        
        $res = $this->Sekolahm->tambah_murid($id_murid,$nama_murid,$jk,$kelas,$alamat);
        if ($res > 0){
            $data['message']="Berhasil menambah data murid";
            print json_encode($data);
        }else{
            $data['message']="Error saat memproses data";
            print json_encode($data);
        }
    }
    function upload_file(){
        $id_murid = $this->input->post('id_murid');
        $nama_murid = $this->input->post('nama_murid');
        $jk = $this->input->post('jk');
        $kelas = $this->input->post('kelas');
        $alamat = $this->input->post('alamat');
        
        
       //tujuan upload//bikin folder baru
        $config['upload_path'] = "./assets/upload/";
        //gunakan mime type
        //untuk file JPG mime type image/jpg 
        
        //bintang berarti semua file bsa
        $config['allowed_types']="*";
        //maximum file
        $config['max_size'] = 0;
        
        $config['overwrite']= true;  
        
        $this->load->library('upload',$config);
        
        if(!$this->upload->do_upload('file')){
            $res=0;
            echo json_encode($this->upload->display_errors());
        }else{
            $meta = $this->upload->data();
            $fileNames=$meta['file_name'];
            //ambil ama file dari file panggil_yang terupload 
            //proses insert 
            $dataInsertArray = array(
                'gambar' => $fileNames,
                'id_murid '=>$id_murid,
                'nama_murid'=>$nama_murid,
                'jk '=>$jk,
                'kelas'=>$kelas,
                'alamat'=>$alamat,
                   
            );
            $this->load->model("Sekolahm");
            $res = $this->Sekolahm->insert_poto("tb_murid",$dataInsertArray);
        }
        if($res > 0){
            $data['message']="file berhasil di upload";
            $data['code']= 200;        
        }else{
             $data['message']="file gagal di upload";
             $data['code']= 500;    
        }
        echo json_encode($data);
    }
    
    function tampil(){
        $this->load->view('welcome_message');
    }
    
   
}
