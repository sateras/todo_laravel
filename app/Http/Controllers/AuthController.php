<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function logout()
    {

        $this->service->logout();

        return redirect(route('login'));
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $this->service->register($data);

        return redirect(route("home"));
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        $this->service->login($data);
        
        return redirect(route("home"));
    }
}
