<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Pendaftaran extends Seeder
{
    public function run()
    {
        $data = [
            [
                "nama" => "matthew",
                "email" => "matthew@gmail.com",
                "password"=> "matthew1221",
                "no_telepon" => "082",
                "jenis_kelamin" => "laki-laki",
            ],
        ];

        $this->db->table('pendaftaran')->insertBatch($data);
    }
}
