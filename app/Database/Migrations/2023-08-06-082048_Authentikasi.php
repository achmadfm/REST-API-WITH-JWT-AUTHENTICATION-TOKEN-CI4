<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Authentikasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('authentikasi', true);
    }

    public function down()
    {
        $this->forge->dropTable('authentikasi', true);
    }
}
