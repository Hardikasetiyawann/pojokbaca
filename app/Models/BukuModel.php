<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\BukuEntity;

class BukuModel extends Model
{
    protected $table            = 'buku';
    protected $primaryKey       = 'id';
    protected $returnType       = BukuEntity::class;
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'dibuat_pada';
    protected $updatedField     = 'diperbarui_pada';
    protected $protectFields    = true;

    /**
     * Kolom-kolom yang boleh diisi (sesuai dengan field tabel `buku`)
     */
    protected $allowedFields = [
        'judul',
        'deskripsi',
        'tahun_terbit',
        'file_sampul',     // nama file gambar sampul
        'isi_buku',        // nama file isi buku (PDF, EPUB)
        'penulis_id',
        'penerbit_id',
        'kategori_id',
        'genre_id',
        'diperbarui_oleh',
    ];

    /**
     * Aturan validasi untuk input buku
     */
    protected $validationRules = [
        'judul'           => 'required|min_length[3]',
        'deskripsi'       => 'permit_empty|string',
        'tahun_terbit'    => 'required|numeric|exact_length[4]',
        'file_sampul'     => 'permit_empty|string',
        'isi_buku'        => 'permit_empty|string',
        'penulis_id'      => 'required|is_natural_no_zero',
        'penerbit_id'     => 'required|is_natural_no_zero',
        'kategori_id'     => 'required|is_natural_no_zero',
        'genre_id'        => 'required|is_natural_no_zero',
        'diperbarui_oleh' => 'permit_empty|is_natural_no_zero',
    ];

    /**
     * Pesan kesalahan yang lebih manusiawi
     */
    protected $validationMessages = [
        'judul' => [
            'required'   => 'Judul buku wajib diisi.',
            'min_length' => 'Judul minimal 3 karakter.',
        ],
        'tahun_terbit' => [
            'required'     => 'Tahun terbit wajib diisi.',
            'numeric'      => 'Tahun terbit harus berupa angka.',
            'exact_length' => 'Tahun terbit harus 4 digit.',
        ],
        'penulis_id' => [
            'required' => 'Penulis harus dipilih.',
        ],
        'penerbit_id' => [
            'required' => 'Penerbit harus dipilih.',
        ],
        'kategori_id' => [
            'required' => 'Kategori harus dipilih.',
        ],
        'genre_id' => [
            'required' => 'Genre harus dipilih.',
        ],
    ];

    public function getRecommendedBooks($limit = 10)
    {
        return $this->select('buku.*, COUNT(peminjaman.id) AS total_peminjaman')
                    ->join('peminjaman', 'peminjaman.buku_id = buku.id', 'left')
                    ->groupBy('buku.id')
                    ->orderBy('total_peminjaman', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

}
