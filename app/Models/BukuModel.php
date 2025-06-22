<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'buku';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\BukuEntity::class;
    protected $useSoftDeletes   = false;

    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'dibuat_pada';
    protected $updatedField     = 'diperbarui_pada';

    protected $protectFields    = true;
    protected $allowedFields    = [
        'judul',
        'deskripsi',
        'tahun_terbit',
        'url_sampul',
        'url_file',
        'penulis_id',
        'penerbit_id',
        'kategori_id',
        'genre_id',
        'diperbarui_oleh'
    ];

    protected $validationRules = [
        'judul'          => 'required|min_length[3]',
        'deskripsi'      => 'permit_empty',
        'tahun_terbit'   => 'required|numeric|exact_length[4]',
        'penulis_id'     => 'required|is_natural_no_zero',
        'penerbit_id'    => 'required|is_natural_no_zero',
        'kategori_id'    => 'required|is_natural_no_zero',
        'genre_id'       => 'required|is_natural_no_zero',
        'diperbarui_oleh'=> 'permit_empty|is_natural_no_zero',
    ];

    protected $validationMessages = [
        'judul' => [
            'required'    => 'Judul buku wajib diisi.',
            'min_length'  => 'Judul minimal 3 karakter.',
        ],
        'tahun_terbit' => [
            'required'     => 'Tahun terbit wajib diisi.',
            'numeric'      => 'Tahun harus berupa angka.',
            'exact_length' => 'Tahun terbit harus 4 digit.',
        ],
        'penulis_id'  => ['required' => 'Penulis harus dipilih.'],
        'penerbit_id' => ['required' => 'Penerbit harus dipilih.'],
        'kategori_id' => ['required' => 'Kategori harus dipilih.'],
        'genre_id'    => ['required' => 'Genre harus dipilih.'],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
