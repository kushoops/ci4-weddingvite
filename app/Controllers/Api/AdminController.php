<?php

namespace App\Controllers\Api;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\GroupModel;
use App\Models\MempelaiModel;

class AdminController extends ResourceController
{

	// POST
	public function register()
	{
		$rules = [
			"username" => "required|is_unique[users.username]",
			"email" => "required|valid_email|is_unique[auth_identities.secret]",
			"password" => "required"
		];
		
			if(!$this->validate($rules)) {
				$response = [
					"status" => false,
					"message" => $this->validator->getErrors(),
					"data" => [] 
				];
			}else {
				$request = \Config\Services::request();
				
				$users = auth()->getProvider();
				$user = new User([
					"username" => $request->getPost("username"),
					"email" => $request->getPost("email"),
					"password" => $request->getPost("password"),
				]);

				$users->save($user);
				$user = $users->findById($users->getInsertID());
				$user->addGroup('admin', 'user');

				$mempelaiObject = new MempelaiModel();
				$mempelaiObject->save([
					"mempelai_id" => $users->getInsertID(), 
					"username" => $request->getPost("username")
				]);

				$response = [
						"status" => true,
						"message" => "Register admin berhasil",
						"data" => []
				];
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
				$groupUsers = new GroupModel();
				$groupUsers = $groupUsers->where('group', 'admin')->findColumn('user_id');
				
				$users = auth()->getProvider();
				$list = [];
				foreach($groupUsers as $user_id) {
					array_push($list, $users->findById($user_id));
				}
				
				$response = [
					"status" => true,
					"message" => "Datar admin",
					"data" => $list
				];
				}
				
		return $this->respondCreated($response);
	}

	// GET
	public function single($user_id)
	{
		if(!auth()->user()->inGroup('admin')) {
			$response = [
				"status" => false,
				"message" => "Pengguna bukan admin",
				"data" => []
			];
		}else {

			$user = auth()->getProvider()->findById($user_id);

			$response = [
				"status" => true,
				"message" => "Info admin",
				"data" => $user
			];
		}

		return $this->respondCreated($response);
	}
	
	// DELETE
	public function remove($admin_id)
	{
		if(!auth()->user()->inGroup('admin')){
			$response = [
				"status" => false,
				"message" => "Pengguna bukan admin",
				"data" => []
				];
			}else {
				$users = auth()->getProvider();
				
				if(!$users->delete($admin_id, true)) {
					$response = [
						"status" => false,
						"message" => "Gagal menghapus admin",
						"data" => []
					];
				}else {
					$response = [
						"status" => true,
						"message" => "Berhasil menghapus admin",
						"data" => []
					];
				}
			}
			
		return $this->respondCreated($response);
	}
}