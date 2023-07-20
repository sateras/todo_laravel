<?php

namespace App\Services;

interface AuthServiceInterface
{
	public function register($data);

	public function login(array $data);

	public function logout();
}
