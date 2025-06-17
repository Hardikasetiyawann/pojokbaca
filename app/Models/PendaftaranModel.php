<?php

namespace App\Models;

use CodeIgniter\Model;

class PendaftaranModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pendaftaran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Entities\Pendaftaran';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "nama",
        "email",
        "password",
        "no_telepon",
        "jenis_kelamin",
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        "nama"=>'required|is_unique[pendaftaran.nama]',
        "email"=>'required',
        "password"=>'required',
        "no_telepon"=>'required',
        "jenis_kelamin"=>'required',
    ];
    protected $validationMessages   = [
        "nama"=>[
            'required'=>'Silakan masukan nama',
            'is_unique'=>'Silakan masukan nama yang lain, nama ini sudah digunakan!',
        ],
        "email"=>['required'=>'Silakan masukan email' ],
        "password"=>['required'=>'Silakan masukan passwors' ],
        "no_telepon"=>['required'=>'Silakan masukan nomor telephon' ],
        "jenis_kelamin"=>['required'=>'Silakan masukan jenis kelamin' ],
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
