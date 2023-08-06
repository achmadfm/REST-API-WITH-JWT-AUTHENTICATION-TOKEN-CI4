<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ModelAuthentikasi;

class Authentikasi extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Silahkan Masukkan email',
                    'valid_email' => 'Silahkan masukkan email yang valud'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan masukkan password'
                ]
            ]
        ];
        $validation->setRules($rules);
        if (!$validation->withRequest($this->request)->run()) {
            return $this->fail($validation->getErrors());
        }

        $model = new ModelAuthentikasi();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $data = $model->getEmail($email);
        if ($data['password'] != md5($password)) {
            return $this->fail("Password tidak sesuai");
        }

        helper('jwt');
        $response = [
            'message' => 'Authentikasi Berhasil dilakukan',
            'data' => $data,
            'access_token' => createJWT($email)
        ];
        return $this->respond($response);
    }
}
