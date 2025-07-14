<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class BukuSeeds extends Seeder
{
    public function run()
    {
        $now = Time::now();

        $data = [
            [
                'judul'           => 'Laut Bercerita',
                'deskripsi'       => 'Novel Laut Bercerita mengisahkan tentang seorang mahasiswa sekaligus aktivis pada masa Orde Baru bernama Biru Laut Wibisana. Cerita ini terinspirasi dari kisah nyata hilangnya para aktivis pada masa pemerintahan Orde Baru. Berlatar era 1990-an hingga 2000-an, novel ini sarat dengan peristiwa traumatis yang tak terlupakan.',
                'file_sampul'     => 'lautbercerita.jpg',
                'isi_buku'        => 'bukulautbercerita.pdf',
                'penulis_id'      => 5,
                'kategori_id'     => 2,
                'tahun_terbit'    => 2017,
                'penerbit_id'     => 1,
                'dibuat_pada'     => $now,
                'diperbarui_pada' => $now,
                'diperbarui_oleh' => 1,
                'genre_id'        => 8
            ],
            [
                'judul'           => 'Bulan',
                'deskripsi'       => 'Namanya Seli, usianya 15 tahun, kelas sepuluh. Dia sama seperti remaja yang lain. Menyukai hal yang sama, mendengarkan lagu-lagu yang sama, pergi ke gerai fast food, menonton serial drama, film, dan hal-hal yang disukai remaja. Tetapi ada sebuah rahasia kecil Seli yang tidak pernah diketahui siapa pun. Sesuatu yang dia simpan sendiri sejak kecil. Sesuatu yang menakjubkan dengan tangannya. Namanya Seli. Dan tangannya bisa mengeluarkan petir.',
                'file_sampul'     => 'bulan.jpg',
                'isi_buku'        => 'Bulan.pdf',
                'penulis_id'      => 6,
                'kategori_id'     => 1,
                'tahun_terbit'    => 2015,
                'penerbit_id'     => 2,
                'dibuat_pada'     => $now,
                'diperbarui_pada' => $now,
                'diperbarui_oleh' => 1,
                'genre_id'        => 9
            ],
            [
                'judul'           => 'Bumi',
                'deskripsi'       => 'Bumi Tere Liye, sebuah novel karya penulis muda ternama, Tere Liye, telah berhasil mencuri perhatian banyak pembaca dengan petualangan serunya yang tak terduga. Dalam novel ini, Tere Liye berhasil menggabungkan antara gaya penulisan jurnalistik yang santai dengan pesan-pesan mendalam yang menghantarkan pembaca pada sebuah perjalanan spiritual.',
                'file_sampul'     => 'bumi.jpg',
                'isi_buku'        => 'Bumi.pdf',
                'penulis_id'      => 6,
                'kategori_id'     => 1,
                'tahun_terbit'    => 2014,
                'penerbit_id'     => 2,
                'dibuat_pada'     => $now,
                'diperbarui_pada' => $now,
                'diperbarui_oleh' => 1,
                'genre_id'        => 3
            ],
            [
                'judul'           => 'Negeri Para Bedebah',
                'deskripsi'       => 'Negeri Para Bedebah adalah sebuah novel thriller politik yang penuh ketegangan dan intrik. Berkisah tentang Thomas, seorang konsultan keuangan brilian yang harus berjuang membersihkan nama baik keluarganya di tengah skandal besar yang mengguncang negeri.',
                'file_sampul'     => 'negeriparabedebah.jpg',
                'isi_buku'        => 'Negeri Para bedebah.pdf',
                'penulis_id'      => 6,
                'kategori_id'     => 1,
                'tahun_terbit'    => 2012,
                'penerbit_id'     => 2,
                'dibuat_pada'     => $now,
                'diperbarui_pada' => $now,
                'diperbarui_oleh' => 1,
                'genre_id'        => 4
            ],
            [
                'judul'           => 'Sagaras',
                'deskripsi'       => 'Novel "Sagaras" merupakan buku ke-13 dalam rangkaian cerita Bumi yang ditulis oleh Tere Liye. Kisah ini melanjutkan perjalanan tiga tokoh utama yaitu, Raib, Seli, dan Ali, di dunia paralel yang penuh keajaiban.',
                'file_sampul'     => 'sagaras.jpg',
                'isi_buku'        => 'Sagaras.pdf',
                'penulis_id'      => 6,
                'kategori_id'     => 1,
                'tahun_terbit'    => 2017,
                'penerbit_id'     => 2,
                'dibuat_pada'     => $now,
                'diperbarui_pada' => $now,
                'diperbarui_oleh' => 1,
                'genre_id'        => 9
            ],
            [
                'judul'           => 'Si Putih',
                'deskripsi'       => 'Kisah ini bermula dari Si Putih yang bukan merupakan hewan biasa. Si Putih merupakan hewan kuno yang lahir di peradaban panjang klan Polaris. Klan Polaris adalah klan yang kerap diserang oleh pandemi.',
                'file_sampul'     => 'siputih.jpg',
                'isi_buku'        => 'Si Putih.pdf',
                'penulis_id'      => 6,
                'kategori_id'     => 1,
                'tahun_terbit'    => 2017,
                'penerbit_id'     => 2,
                'dibuat_pada'     => $now,
                'diperbarui_pada' => $now,
                'diperbarui_oleh' => 1,
                'genre_id'        => 9
            ],
        ];

        $this->db->table('buku')->insertBatch($data);
    }
}
