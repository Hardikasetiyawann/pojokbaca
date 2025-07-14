<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kategori extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ]
        ]);

        $this->forge->addKey('id', true); // Primary Key
        $this->forge->createTable('kategori');
    }

    public function down()
    {
        $this->forge->dropTable('kategori');
    }
}
