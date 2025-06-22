<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BukuSeeds extends Seeder
{
    public function run()
{
    $sampulPath = WRITEPATH . 'uploads/sampul.jpg'; // file lokal contoh
    $filePath = WRITEPATH . 'uploads/buku.pdf';

    $data = [
        [
            'judul' => 'Contoh Buku Lokal',
            'deskripsi' => 'Deskripsi buku lokal.',
            'file_sampul' => file_exists($sampulPath) ? file_get_contents($sampulPath) : null,
            'file_buku' => file_exists($filePath) ? file_get_contents($filePath) : null,
            'penulis_id' => 1,
            'kategori_id' => 1,
            'tahun_terbit' => 2024,
            'penerbit_id' => 1,
            'dibuat_pada' => date('Y-m-d H:i:s'),
            'diperbarui_pada' => date('Y-m-d H:i:s'),
            'diperbarui_oleh' => 1,
            'genre' =>
        ]
    ];

    $this->db->table('buku')->insertBatch($data);
}
}