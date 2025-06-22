<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Genre extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'dibuat_pada' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'diperbarui_pada' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true); // Primary Key
        $this->forge->createTable('genre');
    }

    public function down()
    {
        $this->forge->dropTable('genre');
    }
}
