<?php

namespace App\Models;

use CodeIgniter\Model;

class PenulisModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'penulis';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\PenulisEntity::class;
    protected $useSoftDeletes   = false;

    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama',
        'bio', // harus sama dengan di migration
        'created_at',
        'updated_at'
    ];

    protected $validationRules = [
        'nama' => 'required|min_length[3]|is_unique[penulis.nama]',
        'bio'  => 'permit_empty|string',
    ];

    protected $validationMessages = [
        'nama' => [
            'required'   => 'Nama penulis wajib diisi.',
            'min_length' => 'Nama minimal 3 karakter.',
            'is_unique'  => 'Nama penulis sudah terdaftar.',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
