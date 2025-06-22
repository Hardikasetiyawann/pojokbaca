<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kategori';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'dibuat_pada';
    protected $updatedField     = 'diperbarui_pada';

    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama',
        'deskripsi',
        'dibuat_pada',
        'diperbarui_pada'
    ];

    protected $validationRules = [
        'nama'      => 'required|min_length[3]|is_unique[kategori.nama,id,{id}]',
        'deskripsi' => 'permit_empty|max_length[255]'
    ];

    protected $validationMessages = [
        'nama' => [
            'required'   => 'Nama kategori wajib diisi.',
            'min_length' => 'Nama kategori minimal 3 karakter.',
            'is_unique'  => 'Nama kategori sudah digunakan.',
        ],
        'deskripsi' => [
            'max_length' => 'Deskripsi maksimal 255 karakter.',
        ]
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Opsional: membersihkan dan format nama
    protected $beforeInsert = ['sanitizeNama'];
    protected $beforeUpdate = ['sanitizeNama'];

    protected function sanitizeNama(array $data)
    {
        if (isset($data['data']['nama'])) {
            $data['data']['nama'] = ucwords(strtolower(trim($data['data']['nama'])));
        }
        return $data;
    }
}
