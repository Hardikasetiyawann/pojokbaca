<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeds extends Seeder
{
    public function run()
    {
        $this->call('AdminSeeds');
        $this->call('PenggunaSeeds');
        $this->call('PenulisSeeds');
        $this->call('PenerbitSeeds');
        $this->call('KategoriSeeds');
        $this->call('GenreSeeds');
        $this->call('BukuSeeds');
        $this->call('PenilaianBukuSeeds');
        $this->call('PeminjamanSeeds');
    }
}
