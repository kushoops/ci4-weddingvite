<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UcapanMigration extends Migration
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
                'unsigned' => true
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 32
            ],
            'ucapan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('ucapan');
    }
    
    public function down()
    {
        $this->forge->dropTable('ucapan');
    }
}
