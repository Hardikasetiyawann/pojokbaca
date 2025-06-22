<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeds extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama'          => 'AdminUtama',
                'email'         => 'admin@pojokbaca.com',
                'password'      => password_hash('admin123', PASSWORD_DEFAULT),
                'dibuat_pada'   => '2025-06-19 14:00:00',
                'diperbarui_pada' => '2025-06-19 14:00:00',
            ],
        ];

        $this->db->table('admin')->insertBatch($data);
    }
}
