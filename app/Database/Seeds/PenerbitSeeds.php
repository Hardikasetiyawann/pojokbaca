<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PenerbitSeeds extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama'        => 'KPG (Kepustakaan Populer Gramedia)',
                'alamat'      => 'Jakarta',
                'created_at' => '2017-10-01 00:00:00'
            ],
            [
                'nama'        => 'PT Gramedia Pustaka Utama',
                'alamat'      => 'Jakarta',
                'created_at' => '2012-10-01 00:00:00'
            ],
        ];

        $this->db->table('penerbit')->insertBatch($data);
    }
}
