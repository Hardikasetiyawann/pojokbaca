<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PenulisSeeds extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama'         => 'Tan Malaka',
                'bio'          => 'Penulis populer.',
                'dibuat_pada'  => '2025-06-19 14:00:00'
            ],
            [
                'nama'         => 'D.N. Aidit',
                'bio'          => 'Penulis populer.',
                'dibuat_pada'  => '2025-06-19 14:00:00'
            ],
            [
                'nama'         => 'Soe Hok Gie',
                'bio'          => 'Penulis populer.',
                'dibuat_pada'  => '2025-06-19 14:00:00'
            ],
            [
                'nama'         => 'Pramoedya Ananta Toer',
                'bio'          => 'Penulis populer.',
                'dibuat_pada'  => '2025-06-19 14:00:00'
            ],
            [
                'nama'         => 'Leila S. Chudori',
                'bio'          => 'Penulis populer.',
                'dibuat_pada'  => '2025-06-19 14:00:00'
            ],
            [
                'nama'         => 'Tere Liye',
                'bio'          => 'Penulis populer.',
                'dibuat_pada'  => '2025-06-19 14:00:00'
            ],
        ];

        $this->db->table('penulis')->insertBatch($data);
    }
}
