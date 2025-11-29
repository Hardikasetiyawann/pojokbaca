<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pengguna'; 
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\PenggunaEntity::class; 
    protected $useSoftDeletes   = false;

    protected $useTimestamps = true; 
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $protectFields = true;
    protected $allowedFields = [
        'nama',
        'email',
        'password',
        'no_telepon',
        'jenis_kelamin',
        'tanggal_lahir',
        'avatar_url',
        'bio',
        'role',
        'email_terverifikasi',
        'status_akun',
        'terakhir_login',
    ];

    protected $validationRules = [
        'nama'           => 'required',
        'email'          => 'required|valid_email|is_unique[pengguna.email,id,{id}]',
        'password'       => 'required|min_length[6]',
        'no_telepon'     => 'permit_empty|max_length[20]',
        'jenis_kelamin'  => 'permit_empty|in_list[laki-laki,perempuan]',
    ];

    protected $validationMessages = [
        'nama' => [
            'required' => 'Silakan masukkan nama.',
        ],
        'email' => [
            'required'    => 'Silakan masukkan email.',
            'valid_email' => 'Format email tidak valid.',
            'is_unique'   => 'Email ini sudah terdaftar.',
        ],
        'password' => [
            'required'    => 'Silakan masukkan password.',
            'min_length'  => 'Password minimal 6 karakter.',
        ],
        'no_telepon' => [
            'max_length' => 'Nomor telepon terlalu panjang.',
        ],
        'jenis_kelamin' => [
            'in_list' => 'Jenis kelamin harus laki-laki atau perempuan.',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    protected $beforeInsert = ['hashPassword', 'formatNama'];
    protected $beforeUpdate = ['hashPassword', 'formatNama'];

    protected function hashPassword(array $data)
    {
        if (!empty($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    protected function formatNama(array $data)
    {
        if (!empty($data['data']['nama'])) {
            $data['data']['nama'] = ucwords(strtolower(trim($data['data']['nama'])));
        }
        return $data;
    }
}
