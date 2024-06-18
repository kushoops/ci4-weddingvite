<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TamuMigration extends Migration
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
            'mempelai_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 32
            ],
            'telp' => [
                'type' => 'VARCHAR',
                'constraint' => 16
            ],
            'link' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'opened' => [
                'type' => 'VARCHAR',
                'constraint' => 1
            ],
            'rsvp' => [
                'type' => 'VARCHAR',
                'constraint' => 16
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('tamu');
    }
    
    public function down()
    {
        $this->forge->dropTable('tamu');
    }
}
