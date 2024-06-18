<?php

namespace App\Controllers\Api;

use App\Models\UndanganModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\MempelaiModel;
use App\Models\TamuModel;
use App\Models\UcapanModel;

class UndanganController extends ResourceController
{
	// POST
	public function add()
	{
		if(!auth()->user()->inGroup('admin')) {
			$response = [
				"status" => false,
				"message" => "Pengguna bukan admin",
				"data" => []
			];
		}else {
			$rules = [
				"kode" => "required|is_unique[undangan.kode]",
			];
			
			if(!$this->validate($rules)) {
				$response = [
					"status" => false,
					"message" => $this->validator->getErrors(),
					"data" => [] 
				];
			}else {
				$request = \Config\Services::request();
				
				$undanganObject = new UndanganModel();
				$undangan = ["kode" => $request->getPost("kode")];
				
				$undanganObject->save($undangan);
				
				$response = [
					"status" => true,
					"message" => "Undangan berhasil ditambahkan",
					"data" => []
				];
			}
		}

		return $this->respondCreated($response);
	}

  // GET
	public function list()
	{
		if(!auth()->user()->inGroup('admin')) {
			$response = [
				"status" => false,
				"message" => "Pengguna bukan admin",
				"data" => []
			];
		}else {
			$undanganObject = new UndanganModel();
    	$undangan = $undanganObject->findAll();

			$response = [
				"status" => true,
				"message" => "Datar undangan",
				"data" => $undangan
			];
		}

    return $this->respondCreated($response);
	}

  // DELETE
	public function remove($undangan_id)
	{
		if(!auth()->user()->inGroup('admin')){
			$response = [
					"status" => false,
					"message" => "Pengguna bukan admin",
					"data" => []
			];
		}else {
				$undanganObject = new UndanganModel();
		
				if(!$undanganObject->delete($undangan_id, true)) {
						$response = [
								"status" => false,
								"message" => "Gagal menghapus undangan",
								"data" => []
						];
				}else {
						$response = [
								"status" => true,
								"message" => "Berhasil menghapus undangan",
								"data" => []
						];
				}
		}

		return $this->respondCreated($response);
	}

	// GET
	public function undanganMempelai($mempelai_id)
	{
		if($mempelai_id != auth()->id()) {
			$response = [
				'status' => false,
				'message' => 'Gagal mendapatkan data mempelai',
				'data' => []
			];
		}else {
			$mempelaiObject = new MempelaiModel();
			$tamuObject = new TamuModel();
			$ucapanObject = new UcapanModel();

			if(!$mempelaiObject->find($mempelai_id)) {
				$response = [
					'status' => false,
					'message' => 'Gagal mendapatkan data mempelai',
					'data' => []
				];
			}else {
				$response = [
					'status' => true,
					'message' => 'Berhasil mendapatkan data mempelai',
					'data' => [
						'mempelai' => $mempelaiObject->find($mempelai_id),
						'tamu' => $tamuObject->where('mempelai_id', $mempelai_id)->findAll(),
						'ucapan' => $ucapanObject->where('mempelai_id', $mempelai_id)->findAll()
					]
				];
			}
		}

		return $this->respondCreated($response);
	}
	
	// GET
	public function undanganTamu($mempelai_id, $tamu_id)
	{
		$mempelaiObject = new MempelaiModel();
		$tamuObject = new TamuModel();
		$ucapanObject = new UcapanModel();

		if(!$tamuObject->where(['id' => $tamu_id, 'mempelai_id' => $mempelai_id])->first()) {
			$response = [
				'status' => false,
				'message' => 'Gagal mendapatkan data mempelai',
				'data' => []
			];
		}else {
			$tamuObject->update($tamu_id, ['opened' => '1']);
			$response = [
				'status' => true,
				'message' => 'Berhasil mendapatkan data mempelai',
				'data' => [
					'mempelai' => $mempelaiObject->find($mempelai_id),
					'tamu' => $tamuObject->where('mempelai_id', $mempelai_id)->findAll(),
					'tamuUndangan' => $tamuObject->find($tamu_id),
					'ucapan' => $ucapanObject->where('mempelai_id', $mempelai_id)->findAll()
				]
			];
		}

		return $this->respondCreated($response);
	}
}
