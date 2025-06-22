<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriSeeds extends Seeder
{
    public function run()
    {
        $data = [
            ['nama' => 'Fiksi'],
            ['nama' => 'Non Fiksi'],
            ['nama' => 'Anak-anak'],
            ['nama' => 'Remaja'],
        ];

        $this->db->table('kategori')->insertBatch($data);
    }
}
