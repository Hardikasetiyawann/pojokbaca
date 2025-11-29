<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeds extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama'          => 'Admin1',
                'email'         => 'admin1@pojokbaca.com',
                'password'      => password_hash('admin123', PASSWORD_DEFAULT),
                'created_at'   => '2025-06-19 14:00:00',
                'updated_at' => '2025-06-19 14:00:00',
            ],
        ];

        $this->db->table('admin')->insertBatch($data);
    }
}
