<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pengguna extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
                'unique'     => true,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'no_telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'jenis_kelamin' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => true,
            ],
            'tanggal_lahir' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'avatar_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'bio' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'role' => [
                'type'       => 'ENUM("user", "admin")',
                'default'    => 'user',
                'null'       => false,
            ],
            'email_terverifikasi' => [
                'type'       => 'BOOLEAN',
                'default'    => false,
            ],
            'status_akun' => [
                'type'       => 'ENUM("aktif", "nonaktif", "banned")',
                'default'    => 'aktif',
                'null'       => false,
            ],
            'terakhir_login' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('pengguna');
    }

    public function down()
    {
        $this->forge->dropTable('pengguna');
    }
}
