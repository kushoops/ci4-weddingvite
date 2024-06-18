<?php

namespace App\Models;

use CodeIgniter\Model;

class MempelaiModel extends Model
{
    protected $table            = 'mempelai';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'mempelai_id',
        'username',
        'kode_undangan',
        'jenis_undangan',
        'nama_wanita',
        'nama_pria',
        'cover_bgimg1',
        'cover_bgimg2',
        'cover_bgimg3',
        'music',
        'home_img',
        'pembuka_doa',
        'pembuka_text',
        'mempelai_wanita_img',
        'mempelai_wanita_namalengkap',
        'mempelai_wanita_nchild',
        'mempelai_wanita_namaayah',
        'mempelai_wanita_namaibu',
        'mempelai_wanita_sosmed',
        'mempelai_wanita_linksosmed',
        'mempelai_pria_img',
        'mempelai_pria_namalengkap',
        'mempelai_pria_nchild',
        'mempelai_pria_namaayah',
        'mempelai_pria_namaibu',
        'mempelai_pria_sosmed',
        'mempelai_pria_linksosmed',
        'acara_bgimg',
        'acara_akad_tgl',
        'acara_akad_waktumulai',
        'acara_akad_waktuselesai',
        'acara_akad_tempat',
        'acara_resepsi_tgl',
        'acara_resepsi_waktumulai',
        'acara_resepsi_waktuselesai',
        'acara_resepsi_tempat',
        'acara_linkgooglemap',
        'acara_embededgooglemap',
        'gallery_img1',
        'gallery_img2',
        'gallery_img3',
        'gallery_img4',
        'gallery_img5',
        'gallery_img6',
        'gallery_img7',
        'gallery_img8',
        'gallery_img9',
        'gallery_img10',
        'gallery_img11',
        'gallery_img12',
        'gallery_embededyoutube',
        'amplop1_bank',
        'amplop1_nama',
        'amplop1_norek',
        'amplop2_bank',
        'amplop2_nama',
        'amplop2_norek',
        'penutup_text'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
