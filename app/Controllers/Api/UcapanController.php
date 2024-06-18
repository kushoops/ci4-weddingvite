<?php

namespace App\Controllers\Api;

use App\Models\UcapanModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class UcapanController extends ResourceController
{

	// POST
  public function add($mempelai_id, $nama)
  {
    $rules = [
			"ucapan" => "required"
		];
	
		if(!$this->validate($rules)) {
			$response = [
					"status" => false,
					"message" => $this->validator->getErrors(),
					"data" => [] 
			];
		}else {
			$request = \Config\Services::request();

			$ucapan = [
				"mempelai_id" => $mempelai_id, 
				"nama" => $nama, 
				"ucapan" => $request->getPost("ucapan"),
			];
	
			$ucapanObject = new UcapanModel();
			$ucapanObject->save($ucapan);
	
			$response = [
				"status" => true,
				"message" => "Ucapan berhasil ditambahkan",
				"data" => []
			];
		}

    return $this->respondCreated($response);
  }

	// GET
	public function list($mempelai_id)
	{
		$ucapanObject = new UcapanModel();
  	$ucapan = $ucapanObject->where('mempelai_id', $mempelai_id)->findAll();

		$response = [
			"status" => true,
			"message" => "Datar ucapan",
			"data" => $ucapan
		];

    return $this->respondCreated($response);
	}

	// DELETE
	public function remove($ucapan_id)
	{
		if(!auth()->user()->inGroup('admin', 'user')){
			$response = [
					"status" => false,
					"message" => "Pengguna bukan admin ataupun user",
					"data" => []
			];
		}else {
				$ucapanObject = new UcapanModel();
		
				if(!$ucapanObject->delete($ucapan_id, true)) {
						$response = [
								"status" => false,
								"message" => "Gagal menghapus ucapan",
								"data" => []
						];
				}else {
						$response = [
								"status" => true,
								"message" => "Berhasil menghapus ucapan",
								"data" => []
						];
				}
		}

		return $this->respondCreated($response);
	}
}
