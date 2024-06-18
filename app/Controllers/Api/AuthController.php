<?php

namespace App\Controllers\Api;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class AuthController extends ResourceController
{
	// POST
	public function login()
	{
		if(auth()->loggedIn()) {
			auth()->logout();
		}

		$rules = [
				"email" => "required|valid_email",
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

				$credentials = [
						"email" => $request->getPost("email"),
						"password" => $request->getPost("password")
				];

				$loginAttemp = auth()->attempt($credentials);

				if(!$loginAttemp->isOK()) {
						$response = [
								"status" => false,
								"message" => "Login gagal",
								"data" => []
						];
				}else {
						$users = auth()->getProvider();
						$user = $users->findById(auth()->id());
						$token = $user->generateAccessToken("token");
						$token = $token->raw_token;

						$response = [
								"status" => true,
								"message" => "Login berhasil",
								"data" => [
									"user" => $user,
									"token" => $token
								]
						];
				}
		}

		return $this->respondCreated($response);
	}

	// GET
	public function auth($user_id)
	{
		if($user_id != auth()->id()) {
			$response = [
				'status' => false,
				'message' => 'Login terlebih dahulu',
				'data' => []
			];
		}else {
			$response = [
				'status' => true,
				'message' => 'Selamat datang kembali',
				'data' => []
			];
		}

		return $this->respondCreated($response);
	}

	// GET
	public function logout()
	{
		auth()->logout();
    auth()->user()->revokeAllAccessTokens();

    return $this->respondCreated([
        "status" => true,
        "message" => "Logout berhasil",
        "data" => []
    ]);
	}

	// GET
	public function invalid()
	{
		return $this->respondCreated([
			"status" => false,
			"message" => "Akses ditolak",
			"data" => []
	]);
	}
}
