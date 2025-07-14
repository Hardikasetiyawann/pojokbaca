<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PeminjamanSeeds extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id'         => 1,
                'buku_id'         => 1,
                'tanggal_pinjam'  => '2025-07-10',
                'tanggal_kembali' => '2025-07-17',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'         => 2,
                'buku_id'         => 1,
                'tanggal_pinjam'  => '2025-07-11',
                'tanggal_kembali' => '2025-07-18',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('peminjaman')->insertBatch($data);
    }
}
