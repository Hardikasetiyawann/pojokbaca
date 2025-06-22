<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GenreSeeds extends Seeder
{
    public function run()
    {
        $data = [
            ['nama' => 'Novel'],
            ['nama' => 'Cerpen'],
            ['nama' => 'Fantasi'],
            ['nama' => 'Fiksi Ilmiah'],
            ['nama' => 'Horor'],
            ['nama' => 'Romantis'],
            ['nama' => 'Misteri'],
            ['nama' => 'Sejarah'],
            ['nama' => 'Aksi dan Petualangan'],
            ['nama' => 'Thriller'],
            ['nama' => 'Teenlit'],
            ['nama' => 'Chicklit'],
            ['nama' => 'Biografi'],
            ['nama' => 'Autobiografi'],
            ['nama' => 'Ilmiah'],
            ['nama' => 'Motivasi'],
            ['nama' => 'Pengembangan Diri'],
            ['nama' => 'Kesehatan'],
            ['nama' => 'Memasak'],
            ['nama' => 'Ensiklopedia'],
        ];

        $this->db->table('genre')->insertBatch($data);
    }
}
