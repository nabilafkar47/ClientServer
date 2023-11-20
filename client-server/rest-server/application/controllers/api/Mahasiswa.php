<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Mahasiswa extends CI_Controller { //harus pakai CI_Controller

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct; //tambahkan
    }

    public function __construct()
    {
        parent::__construct();
        $this->__resTraitConstruct(); //tambahkan
        $this->load->model('Mahasiswa_model', 'mahasiswa');

        $this->methods['index_get']['limit'] = 200;
        $this->methods['index_delete']['limit'] = 100;
        $this->methods['index_post']['limit'] = 200;
        $this->methods['index_put']['limit'] = 200;
    }

    public function index_get()
    {
        $id = $this->get('id');
        if ($id === null) {
            $mahasiswa = $this->mahasiswa->getMahasiswa();
        } else {
            $mahasiswa = $this->mahasiswa->getMahasiswa($id);
        }
        
        if ($mahasiswa) {
            //cara untuk menampilkan data dalam format json
            $this->response([
                'status' => true,
                'data' => $mahasiswa
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id tidak ditemukan!'
            ], 404);
        }
        
    }

    public function index_delete()
    {
        $id = $this->delete('id');
        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'harus menyertakan id!'
            ], 400);
        } else {
            if ($this->mahasiswa->deleteMahasiswa($id) > 0){
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'berhasil dihapus'
                ], 200); //harusnya 204
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'id tidak ditemukan!'
                ], 400);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'nrp' => $this->post('nrp'),
            'nama' => $this->post('nama'),
            'email' => $this->post('email'),
            'jurusan' => $this->post('jurusan')
        ];

        if ($this->mahasiswa->createMahasiswa($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'data baru berhasil ditambahkan'
            ], 201);
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal menambahkan data baru!'
            ], 400);
        }
    }

    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'nrp' => $this->put('nrp'),
            'nama' => $this->put('nama'),
            'email' => $this->put('email'),
            'jurusan' => $this->put('jurusan')
        ];

        if ($this->mahasiswa->updateMahasiswa($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'data berhasil diubah'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal mengubah data!'
            ], 400);
        }
    }

}