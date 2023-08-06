<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPegawai extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pegawai';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'email'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nama' => 'required',
        'email' => 'required|valid_email'
    ];
    protected $validationMessages   = [
        'nama' => [
            'required' => 'Silahkan masukkan nama'
        ],
        'email' => [
            'required' => 'Silahkan masukkan email',
            'valid_email' => 'Email yang dimasukkan tidak valid'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
