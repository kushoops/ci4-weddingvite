<?php

namespace App\Controllers\Api;

use App\Models\MempelaiModel;
use App\Models\TamuModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\Shield\Entities\User;

use function PHPUnit\Framework\isEmpty;

class MempelaiController extends ResourceController
{
  // Post
	public function register()
	{
			if (!auth()->user()->inGroup('admin')) {
					$response = [
							"status" => false,
							"message" => "Pengguna bukan admin",
							"data" => []
					];
			}else {
				$rules = [
					"username" => "required|is_unique[users.username]",
					"email" => "required|valid_email|is_unique[auth_identities.secret]",
					"password" => "required",
					"kode_undangan" => "required",
					"jenis_undangan" => "required"
				];
			
				if(!$this->validate($rules)) {
					$response = [
							"status" => false,
							"message" => $this->validator->getErrors(),
							"data" => [] 
					];
				}else {
					$request = \Config\Services::request();
			
					$mempelaiObject = new MempelaiModel();
					$users = auth()->getProvider();
					$user = new User([
							"username" => $request->getPost("username"),
							"email" => $request->getPost("email"),
							"password" => $request->getPost("password"),
					]);
		
					$users->save($user);
					$user = $users->findById($users->getInsertID());
					$users->addToDefaultGroup($user);
					$mempelaiObject->save([
						"mempelai_id" => $users->getInsertID(), 
						"username" => $request->getPost("username"),
						"kode_undangan" => $request->getPost("kode_undangan"), 
						"jenis_undangan" => $request->getPost("jenis_undangan"),
					]);
			
					$response = [
						"status" => true,
						"message" => "Register mempelai berhasil",
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
			$mempelaiObject = new MempelaiModel();
    	$undangan = $mempelaiObject->findAll();

			$response = [
				"status" => true,
				"message" => "Datar mempelai",
				"data" => $undangan
			];
		}

    return $this->respondCreated($response);
	}
	
	// GET
	public function single($mempelai_id)
	{
		if(!auth()->user()->inGroup('admin', 'user')) {
			$response = [
				"status" => false,
				"message" => "Pengguna bukan admin",
				"data" => []
			];
		}else {
			$mempelaiObject = new MempelaiModel();
    	$mempelai = $mempelaiObject->where('mempelai_id', $mempelai_id)->first();

			$response = [
				"status" => true,
				"message" => "Info mempelai",
				"data" => $mempelai
			];
		}

    return $this->respondCreated($response);
	}

	// PUT
	public function change($mempelai_id)
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
				
				$mempelaiObject = new MempelaiModel();
				$mempelai = $mempelaiObject->where('mempelai_id', $mempelai_id)->first();

				$data = $this->manageFile($request, $data, 'old_cover_bgimg1', 'cover_bgimg1', 'username');
				$data = $this->manageFile($request, $data, 'old_cover_bgimg2', 'cover_bgimg2', 'username');
				$data = $this->manageFile($request, $data, 'old_cover_bgimg3', 'cover_bgimg3', 'username');
				$data = $this->manageFile($request, $data, 'old_music', 'music', 'username');
				$data = $this->manageFile($request, $data, 'old_home_img', 'home_img', 'username');
				$data = $this->manageFile($request, $data, 'old_mempelai_wanita_img', 'mempelai_wanita_img', 'username');
				$data = $this->manageFile($request, $data, 'old_mempelai_pria_img', 'mempelai_pria_img', 'username');
				$data = $this->manageFile($request, $data, 'old_acara_bgimg', 'acara_bgimg', 'username');
				$data = $this->manageFile($request, $data, 'old_gallery_img1', 'gallery_img1', 'username');
				$data = $this->manageFile($request, $data, 'old_gallery_img2', 'gallery_img2', 'username');
				$data = $this->manageFile($request, $data, 'old_gallery_img3', 'gallery_img3', 'username');
				$data = $this->manageFile($request, $data, 'old_gallery_img4', 'gallery_img4', 'username');
				$data = $this->manageFile($request, $data, 'old_gallery_img5', 'gallery_img5', 'username');
				$data = $this->manageFile($request, $data, 'old_gallery_img6', 'gallery_img6', 'username');
				$data = $this->manageFile($request, $data, 'old_gallery_img7', 'gallery_img7', 'username');
				$data = $this->manageFile($request, $data, 'old_gallery_img8', 'gallery_img8', 'username');
				$data = $this->manageFile($request, $data, 'old_gallery_img9', 'gallery_img9', 'username');
				$data = $this->manageFile($request, $data, 'old_gallery_img10', 'gallery_img10', 'username');
				$data = $this->manageFile($request, $data, 'old_gallery_img11', 'gallery_img11', 'username');
				$data = $this->manageFile($request, $data, 'old_gallery_img12', 'gallery_img12', 'username');

				if(!$mempelaiObject->update($mempelai['id'], $data)) {
					$response = [
						"status" => false,
						"message" => "Gagal mengubah data mempelai",
						"data" => []
					];
				}else {
					$response = [
						"status" => true,
						"message" => "Berhasil mengubah data mempelai",
						"data" => []
					];
				}
			}
		}

		return $this->respondCreated($response);
	}
	public function manageFile($request, $data , $oldFileName, $fileName, $fileFolderName)
	{
		$imageFile = $request->getFile($fileName);
		if(!empty($imageFile)) {
			$imageName = $imageFile->getName();
			$imageArrays = explode(".", $imageName);
			$newImageName = reset($imageArrays) . "_" . round(microtime(true)) . "." . end($imageArrays);
			
			if($imageFile->move("assets/mempelai/{$data[$fileFolderName]}", $newImageName)) {
				if(!empty($data[$oldFileName])) {
					if($data[$oldFileName] != "undefined") {
						unlink("assets/mempelai/{$data[$fileFolderName]}/" . $data[$oldFileName]);
					}
				}
				$data[$fileName] = $newImageName;
				unset($data[$oldFileName]);
			}

		}else {
			if(!empty($data[$oldFileName])) {
					$data[$fileName] = $data[$oldFileName];
					unset($data[$oldFileName]);
			}
		}

		return $data;
	}

	// DELETE
	public function remove($mempelai_id)
	{
		if(!auth()->user()->inGroup('admin')){
			$response = [
					"status" => false,
					"message" => "Pengguna bukan admin",
					"data" => []
			];
		}else {
				$mempelaiObject = new MempelaiModel();
				$mempelai = $mempelaiObject->where('mempelai_id', $mempelai_id)->first();
				$users = auth()->getProvider();
		
				if(!$mempelaiObject->delete($mempelai['id'], true) || !$users->delete($mempelai_id, true)) {
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

}
