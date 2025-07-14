<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'peminjaman'; // Gantilah dari 'peminjamans' ke 'peminjaman'
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields    = [
        'user_id',
        'buku_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at'; // Hanya aktif kalau pakai soft delete

    // Validation (optional, bisa ditambahkan sesuai kebutuhan)
    protected $validationRules      = [
        'user_id'         => 'required|integer',
        'buku_id'         => 'required|integer',
        'tanggal_pinjam'  => 'required|valid_date',
    ];
    protected $validationMessages   = [];
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
