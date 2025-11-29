<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PenilaianBukuSeeds extends Seeder
{
    public function run()
    {
        $data = [
            [
                'pengguna_id' => 1,
                'buku_id'     => 1, 
                'penilaian'   => 5,
                'created_at' => '2025-06-19 14:00:00', 
            ],
        ];

        $this->db->table('penilaian_buku')->insertBatch($data);
    }
}
