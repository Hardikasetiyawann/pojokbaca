<?php

namespace App\Models;

use CodeIgniter\Model;

class PenilaianBukuModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'penilaian_buku'; // harus konsisten huruf kecil
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\PenilaianBukuEntity::class;
    protected $useSoftDeletes   = false;

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'dibuat_pada';
    protected $updatedField  = 'diperbarui_pada';

    protected $protectFields = true;
    protected $allowedFields = [
        'pengguna_id',
        'buku_id',
        'penilaian',
        'komentar',
        'dibuat_pada',
        'diperbarui_pada'
    ];

    protected $validationRules = [
        'pengguna_id' => 'required|integer',
        'buku_id'     => 'required|integer',
        'penilaian'   => 'required|integer|greater_than_equal_to[1]|less_than_equal_to[5]',
        'komentar'    => 'permit_empty|string|max_length[500]',
    ];

    protected $validationMessages = [
        'pengguna_id' => [
            'required' => 'ID Pengguna wajib diisi.',
            'integer'  => 'ID Pengguna harus berupa angka.',
        ],
        'buku_id' => [
            'required' => 'ID Buku wajib diisi.',
            'integer'  => 'ID Buku harus berupa angka.',
        ],
        'penilaian' => [
            'required'              => 'Rating wajib diisi.',
            'integer'               => 'Rating harus berupa angka.',
            'greater_than_equal_to' => 'Minimal rating adalah 1.',
            'less_than_equal_to'    => 'Maksimal rating adalah 5.',
        ],
        'komentar' => [
            'max_length' => 'Komentar maksimal 500 karakter.',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
