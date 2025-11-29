<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Buku extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'judul' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'file_sampul' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'file_buku' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'penulis_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'kategori_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'tahun_terbit' => [
                'type' => 'YEAR',
            ],
            'penerbit_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'diperbarui_oleh' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'genre_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);

        
        $this->forge->addForeignKey('penulis_id', 'penulis', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('kategori_id', 'kategori', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('penerbit_id', 'penerbit', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('diperbarui_oleh', 'admin', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('genre_id', 'genre', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('buku');
    }

    public function down()
    {
        $this->forge->dropTable('buku', true);
    }
}
