<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UndanganMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'kode' => [
                'type' => 'VARCHAR',
                'constraint' => 16
            ]
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('undangan');
    }

    public function down()
    {
        $this->forge->dropTable('undangan');
    }
}
