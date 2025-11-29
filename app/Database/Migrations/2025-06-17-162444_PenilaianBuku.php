<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PenilaianBuku extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'pengguna_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'buku_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'penilaian' => [
                'type'       => 'TINYINT',
                'constraint' => 1, // nilai 1–5
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['pengguna_id', 'buku_id']);


        // Pastikan tabel 'pengguna' dan 'buku' sudah dibuat lebih dulu
        $this->forge->addForeignKey('pengguna_id', 'pengguna', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('buku_id', 'buku', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('penilaian_buku');
    }

    public function down()
    {
        $this->forge->dropTable('penilaian_buku');
    }
}
