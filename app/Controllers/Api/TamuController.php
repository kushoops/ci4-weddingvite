<?php

namespace App\Controllers\Api;

use App\Models\MempelaiModel;
use App\Models\TamuModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\Shield\Entities\User;

class TamuController extends ResourceController
{
  // POST
  public function add($mempelai_id)
  {
    if (!auth()->user()->inGroup('admin', 'user')) {
        $response = [
            "status" => false,
            "message" => "Pengguna bukan admin atupun user",
            "data" => []
        ];
    }else {
      $rules = [
        "nama" => "required",
        "telp" => "required|numeric",
      ];
    
      if(!$this->validate($rules)) {
        $response = [
            "status" => false,
            "message" => $this->validator->getErrors(),
            "data" => [] 
        ];
      }else {
        $request = \Config\Services::request();

        $tamu = [
          "mempelai_id" => $mempelai_id, 
          "nama" => $request->getPost("nama"),
          "telp" => $request->getPost("telp"),
        ];
    
        $mempelaiObject = new MempelaiModel();
        $mempelai = $mempelaiObject->where('id', $mempelai_id)->first();

        $tamuObject = new TamuModel();
        $tamuObject->save($tamu);
        $tamu = $tamuObject->where('id', $tamuObject->getInsertID())->first();
        $tamuObject->update($tamu['id'], ["link" => "https://api.whatsapp.com/send?phone={$tamu['telp']}&text=http://localhost:8080/undangan/{$mempelai['kode_undangan']}?{$mempelai_id}/{$tamu['id']}",]);
    
        $response = [
          "status" => true,
          "message" => "Tamu berhasil ditambahkan",
          "data" => []
        ];
      }
    }

    return $this->respondCreated($response);
  }

  // GET
  public function list($mempelai_id)
  {
    if(!auth()->user()->inGroup('admin', 'user')) {
			$response = [
				"status" => false,
				"message" => "Pengguna bukan admin ataupun user",
				"data" => []
			];
		}else {
			$tamuObject = new TamuModel();
    	$tamu = $tamuObject->where('mempelai_id', $mempelai_id)->findAll();

			$response = [
				"status" => true,
				"message" => "Datar tamu",
				"data" => $tamu
			];
		}

    return $this->respondCreated($response);
  }

  // GET
  public function single($tamu_id)
  {
    if(!auth()->user()->inGroup('admin', 'user')) {
			$response = [
				"status" => false,
				"message" => "Pengguna bukan admin ataupun user",
				"data" => []
			];
		}else {
			$tamuObject = new TamuModel();
    	$tamu = $tamuObject->where('id', $tamu_id)->first();

			$response = [
				"status" => true,
				"message" => "Info tamu",
				"data" => $tamu
			];
		}

    return $this->respondCreated($response);
  }

  // PUT
  public function change($tamu_id)
  {
		if(!auth()->user()->inGroup('admin', 'user')) {
			$response = [
				"status" => false,
				"message" => "Pengguna bukan admin atupun user",
				"data" => []
			];
		}else {
			$rules = [
				"_method" => "required",
			];
			
			if(!$this->validate($rules)) {
				$response = [
					"status" => false,
					"message" => $this->validator->getErrors(),
					"data" => [] 
				];
			}else {
				$request = \Config\Services::request();
				$data = $request->getPost();
				unset($data['_method']);
				
				$tamuObject = new TamuModel();

				if(!$tamuObject->update($tamu_id, $data)) {
					$response = [
						"status" => false,
						"message" => "Gagal mengubah data tamu",
						"data" => []
					];
				}else {
					$response = [
						"status" => true,
						"message" => "Berhasil mengubah data tamu",
						"data" => []
					];
				}
			}
		}

		return $this->respondCreated($response);
	}

  // PUT
  public function changeOpened($tamu_id)
  {
    $rules = [
      "_method" => "required",
    ];
    
    if(!$this->validate($rules)) {
      $response = [
        "status" => false,
        "message" => $this->validator->getErrors(),
        "data" => [] 
      ];
    }else {
      $request = \Config\Services::request();
      $data = $request->getPost();
      unset($data['_method']);
      
      $tamuObject = new TamuModel();

      if(!$tamuObject->update($tamu_id, ['opened' => true])) {
        $response = [
          "status" => false,
          "message" => "Gagal mengubah data tamu",
          "data" => []
        ];
      }else {
        $response = [
          "status" => true,
          "message" => "Berhasil mengubah data tamu",
          "data" => []
        ];
      }
    }

    return $this->respondCreated($response);
  }
  
  // PUT
  public function changeRSVP($tamu_id)
  {
    $rules = [
      "_method" => "required",
      "rsvp" => "required",
    ];
    
    if(!$this->validate($rules)) {
      $response = [
        "status" => false,
        "message" => $this->validator->getErrors(),
        "data" => [] 
      ];
    }else {
      $request = \Config\Services::request();
      $data = $request->getPost();
      unset($data['_method']);
      
      $tamuObject = new TamuModel();

      if(!$tamuObject->update($tamu_id, $data)) {
        $response = [
          "status" => false,
          "message" => "Gagal mengubah data tamu",
          "data" => []
        ];
      }else {
        $response = [
          "status" => true,
          "message" => "Berhasil mengubah data tamu",
          "data" => []
        ];
      }
    }

    return $this->respondCreated($response);
  }

  // DELETE
  public function remove($tamu_id)
  {
		if(!auth()->user()->inGroup('admin', 'user')){
			$response = [
					"status" => false,
					"message" => "Pengguna bukan admin ataupun user",
					"data" => []
			];
		}else {
				$tamuObject = new TamuModel();
		
				if(!$tamuObject->delete($tamu_id, true)) {
						$response = [
								"status" => false,
								"message" => "Gagal menghapus tamu",
								"data" => []
						];
				}else {
						$response = [
								"status" => true,
								"message" => "Berhasil menghapus tamu",
								"data" => []
						];
				}
		}

		return $this->respondCreated($response);
	}
}
