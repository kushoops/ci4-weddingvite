<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MempelaiMigration extends Migration
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
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 32,
            ],
            'kode_undangan' => [
                'type' => 'VARCHAR',
                'constraint' => 16,
            ],
            'jenis_undangan' => [
                'type' => 'VARCHAR',
                'constraint' => 16,
            ],
            'nama_wanita' => [
                'type' => 'VARCHAR',
                'constraint' => 32
            ],
            'nama_pria' => [
                'type' => 'VARCHAR',
                'constraint' => 32
            ],
            'cover_bgimg1' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'cover_bgimg2' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'cover_bgimg3' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'music' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'home_img' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'pembuka_doa' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'pembuka_text' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'mempelai_wanita_img' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'mempelai_wanita_namalengkap' => [
                'type' => 'VARCHAR',
                'constraint' => 32
            ],
            'mempelai_wanita_nchild' => [
                'type' => 'VARCHAR',
                'constraint' => 2
            ],
            'mempelai_wanita_namaayah' => [
                'type' => 'VARCHAR',
                'constraint' => 32
            ],
            'mempelai_wanita_namaibu' => [
                'type' => 'VARCHAR',
                'constraint' => 32
            ],
            'mempelai_wanita_sosmed' => [
                'type' => 'VARCHAR',
                'constraint' => 16
            ],
            'mempelai_wanita_linksosmed' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'mempelai_pria_img' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'mempelai_pria_namalengkap' => [
                'type' => 'VARCHAR',
                'constraint' => 32
            ],
            'mempelai_pria_nchild' => [
                'type' => 'VARCHAR',
                'constraint' => 2
            ],
            'mempelai_pria_namaayah' => [
                'type' => 'VARCHAR',
                'constraint' => 32
            ],
            'mempelai_pria_namaibu' => [
                'type' => 'VARCHAR',
                'constraint' => 32
            ],
            'mempelai_pria_sosmed' => [
                'type' => 'VARCHAR',
                'constraint' => 16
            ],
            'mempelai_pria_linksosmed' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'acara_bgimg' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'acara_akad_tgl' => [
                'type' => 'VARCHAR',
                'constraint' => 10
            ],
            'acara_akad_waktumulai' => [
                'type' => 'VARCHAR',
                'constraint' => 5
            ],
            'acara_akad_waktuselesai' => [
                'type' => 'VARCHAR',
                'constraint' => 5
            ],
            'acara_akad_tempat' => [
                'type' => 'VARCHAR',
                'constraint' => 64
            ],
            'acara_resepsi_tgl' => [
                'type' => 'VARCHAR',
                'constraint' => 10
            ],
            'acara_resepsi_waktumulai' => [
                'type' => 'VARCHAR',
                'constraint' => 5
            ],
            'acara_resepsi_waktuselesai' => [
                'type' => 'VARCHAR',
                'constraint' => 5
            ],
            'acara_resepsi_tempat' => [
                'type' => 'VARCHAR',
                'constraint' => 64
            ],
            'acara_linkgooglemap' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'acara_embededgooglemap' => [
                'type' => 'VARCHAR',
                'constraint' => 512
            ],
            'gallery_img1' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'gallery_img2' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'gallery_img3' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'gallery_img4' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'gallery_img5' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'gallery_img6' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'gallery_img7' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'gallery_img8' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'gallery_img9' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'gallery_img10' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'gallery_img11' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'gallery_img12' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'gallery_embededyoutube' => [
                'type' => 'VARCHAR',
                'constraint' => 512
            ],
            'amplop1_bank' => [
                'type' => 'VARCHAR',
                'constraint' => 16
            ],
            'amplop1_nama' => [
                'type' => 'VARCHAR',
                'constraint' => 32
            ],
            'amplop1_norek' => [
                'type' => 'VARCHAR',
                'constraint' => 16
            ],
            'amplop2_bank' => [
                'type' => 'VARCHAR',
                'constraint' => 16
            ],
            'amplop2_nama' => [
                'type' => 'VARCHAR',
                'constraint' => 32
            ],
            'amplop2_norek' => [
                'type' => 'VARCHAR',
                'constraint' => 16
            ],
            'penutup_text' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('mempelai');
    }

    public function down()
    {
        $this->forge->dropTable('mempelai');
    }
}
