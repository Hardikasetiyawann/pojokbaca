<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BukuSeeds extends Seeder
{
    public function run()
    {
        $data = [
            [
                'judul'            => 'Belajar CodeIgniter 4',
                'penulis_id'       => 1,
                'penerbit_id'      => 1,
                'kategori_id'      => 1,
                'tahun_terbit'     => 2024,
                'diperbarui_oleh'  => 1,
                'dibuat_pada'      => '2025-06-19 14:00:00',
                'diperbarui_pada'  => '2025-06-19 14:00:00',
            ],

        ];
        $this->db->table('buku')->insertBatch($data);
    }
}
