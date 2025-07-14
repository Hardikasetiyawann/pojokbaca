<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Peminjaman extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'              => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id'         => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'buku_id'         => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'tanggal_pinjam'  => [
                'type' => 'DATE',
            ],
            'tanggal_kembali' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'created_at'      => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at'      => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);

        // ✅ Foreign key seharusnya dari user_id dan buku_id
        $this->forge->addForeignKey('user_id', 'pengguna', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('buku_id', 'buku', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('peminjaman');
    }

    public function down()
    {
        $this->forge->dropTable('peminjaman');
    }
}
