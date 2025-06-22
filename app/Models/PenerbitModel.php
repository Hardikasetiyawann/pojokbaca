<?php

namespace App\Models;

use CodeIgniter\Model;

class PenerbitModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'penerbit'; 
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\PenerbitEntity::class;
    protected $useSoftDeletes   = false;

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'dibuat_pada';
    protected $updatedField  = 'diperbarui_pada';

    protected $protectFields = true;
    protected $allowedFields = [
        'nama',
        'alamat',
        'kontak',
        'dibuat_pada',
        'diperbarui_pada'
    ];

    protected $validationRules = [
        'nama'   => 'required|min_length[3]|is_unique[penerbit.nama,id,{id}]',
        'alamat' => 'permit_empty|max_length[255]',
        'kontak' => 'permit_empty|max_length[50]'
    ];

    protected $validationMessages = [
        'nama' => [
            'required'   => 'Nama penerbit wajib diisi.',
            'min_length' => 'Nama penerbit minimal 3 karakter.',
            'is_unique'  => 'Nama penerbit sudah digunakan.',
        ],
        'alamat' => [
            'max_length' => 'Alamat penerbit maksimal 255 karakter.',
        ],
        'kontak' => [
            'max_length' => 'Kontak maksimal 50 karakter.',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    protected $beforeInsert = ['formatNama'];
    protected $beforeUpdate = ['formatNama'];

    protected function formatNama(array $data)
    {
        if (isset($data['data']['nama'])) {
            $nama = preg_replace('/\s+/', ' ', trim($data['data']['nama']));
            $data['data']['nama'] = ucwords(strtolower($nama));
        }
        return $data;
    }
}
