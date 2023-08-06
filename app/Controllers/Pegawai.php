<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ModelPegawai;

class Pegawai extends ResourceController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new ModelPegawai();
    }

    public function index()
    {
        $data = $this->model->orderBy('nama', 'asc')->findAll();
        return $this->respond($data, 200);
    }

    public function show($id = null)
    {
        $data = $this->model->where('id', $id)->findAll();
        if ($data) {
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("Data tidak ditemukan untuk id $id");
        }
    }

    public function create()
    {
        // $data = [
        //     'nama' => $this->request->getVar('nama'),
        //     'email' => $this->request->getVar('email')
        // ];
        $data = $this->request->getPost();
        // $this->model->save($data);
        if (!$this->model->save($data)) {
            return $this->fail($this->model->errors());
        }
        $response = [
            'status' => 201,
            'error' => null,
            'message' => [
                "Data berhasil ditambahkan"
            ]
        ];

        return $this->respond($response);
    }

    public function update($id = null)
    {
        $data = $this->request->getRawInput();
        $data['id'] = $id;
        $isExists = $this->model->where('id', $id)->findAll();
        if (!$isExists) {
            return $this->failNotFound("Data tidak ditemukan untuk id $id");
        }

        if (!$this->model->save($data)) {
            return $this->fail($this->model->errors());
        }

        $response = [
            'status' => 200,
            'error' => null,
            'message' => [
                'success' => "Data Berhasil diupdate untuk id $id"
            ]
        ];

        return $this->respondUpdated($response);
    }

    public function delete($id = null)
    {
        $data = $this->model->where('id', $id)->findAll();
        if ($data) {
            $this->model->delete($id);
            $response = [
                'status' => 200,
                'error' => null,
                'message' => [
                    'success' => 'Data Berhasil dihapus'
                ]
            ];

            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound("Data tidak ditemukan");
        }
    }
}
