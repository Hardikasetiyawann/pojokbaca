<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PenggunaSeeds extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        $today = date('Y-m-d');

        $data = [
            [
                'nama'                => 'Hardika',
                'email'               => 'hardika@gmail.com',
                'password'            => password_hash('hardika1221', PASSWORD_DEFAULT),
                'no_telepon'          => '082123456789',
                'jenis_kelamin'       => 'laki-laki',
                'tanggal_lahir'       => '2005-08-08',
                'avatar_url'          => null,
                'bio'                 => 'saya keren',
                'role'                => 'user',
                'email_terverifikasi' => true,
                'status_akun'         => 'aktif',
                'terakhir_login'      => $today,
                'dibuat_pada'         => $now,
                'diperbarui_pada'     => null,
            ],
            [
                'nama'                => 'Fadly',
                'email'               => 'fadly@gmail.com',
                'password'            => password_hash('fadly1221', PASSWORD_DEFAULT),
                'no_telepon'          => '082123456789',
                'jenis_kelamin'       => 'laki-laki',
                'tanggal_lahir'       => '2005-08-08',
                'avatar_url'          => null,
                'bio'                 => 'saya keren banget',
                'role'                => 'user',
                'email_terverifikasi' => true,
                'status_akun'         => 'aktif',
                'terakhir_login'      => $today,
                'dibuat_pada'         => $now,
                'diperbarui_pada'     => null,
            ],
            [
                'nama'                => 'Errik',
                'email'               => 'erik@gmail.com',
                'password'            => password_hash('errik1221', PASSWORD_DEFAULT),
                'no_telepon'          => '082123456789',
                'jenis_kelamin'       => 'laki-laki',
                'tanggal_lahir'       => '2005-08-08',
                'avatar_url'          => null,
                'bio'                 => 'saya keren',
                'role'                => 'user',
                'email_terverifikasi' => true,
                'status_akun'         => 'aktif',
                'terakhir_login'      => $today,
                'dibuat_pada'         => $now,
                'diperbarui_pada'     => null,
            ],
            [
                'nama'                => 'Reza',
                'email'               => 'reza@gmail.com',
                'password'            => password_hash('reza1221', PASSWORD_DEFAULT),
                'no_telepon'          => '082123456789',
                'jenis_kelamin'       => 'laki-laki',
                'tanggal_lahir'       => '2005-08-08',
                'avatar_url'          => null,
                'bio'                 => 'saya keren',
                'role'                => 'user',
                'email_terverifikasi' => true,
                'status_akun'         => 'aktif',
                'terakhir_login'      => $today,
                'dibuat_pada'         => $now,
                'diperbarui_pada'     => null,
            ],
            [
                'nama'                => 'Fattah',
                'email'               => 'fattah@gmail.com',
                'password'            => password_hash('fattah1221', PASSWORD_DEFAULT),
                'no_telepon'          => '082123456789',
                'jenis_kelamin'       => 'laki-laki',
                'tanggal_lahir'       => '2005-08-08',
                'avatar_url'          => null,
                'bio'                 => 'saya keren',
                'role'                => 'user',
                'email_terverifikasi' => true,
                'status_akun'         => 'aktif',
                'terakhir_login'      => $today,
                'dibuat_pada'         => $now,
                'diperbarui_pada'     => null,
            ],
            [
                'nama'                => 'Adisa',
                'email'               => 'adisa@gmail.com',
                'password'            => password_hash('adisa1221', PASSWORD_DEFAULT),
                'no_telepon'          => '082123456789',
                'jenis_kelamin'       => 'laki-laki',
                'tanggal_lahir'       => '2005-08-08',
                'avatar_url'          => null,
                'bio'                 => 'saya keren',
                'role'                => 'user',
                'email_terverifikasi' => true,
                'status_akun'         => 'aktif',
                'terakhir_login'      => $today,
                'dibuat_pada'         => $now,
                'diperbarui_pada'     => null,
            ],
        ];

        $this->db->table('pengguna')->insertBatch($data);
    }
}
