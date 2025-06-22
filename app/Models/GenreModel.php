<?php

namespace App\Models;

use CodeIgniter\Model;

class GenreModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'genre';
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
        'nama'      => 'required|min_length[3]|is_unique[genre.nama,id,{id}]',
        'deskripsi' => 'permit_empty|max_length[255]'
    ];

    protected $validationMessages = [
        'nama' => [
            'required'   => 'Nama genre wajib diisi.',
            'min_length' => 'Nama genre minimal 3 karakter.',
            'is_unique'  => 'Nama genre sudah ada, silakan gunakan nama lain.'
        ],
        'deskripsi' => [
            'max_length' => 'Deskripsi terlalu panjang. Maksimal 255 karakter.'
        ]
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Opsional: membersihkan spasi nama
    protected $beforeInsert = ['cleanNama'];
    protected $beforeUpdate = ['cleanNama'];

    protected function cleanNama(array $data)
    {
        if (isset($data['data']['nama'])) {
            $data['data']['nama'] = trim($data['data']['nama']);
        }
        return $data;
    }
}
