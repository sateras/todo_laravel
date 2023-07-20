<?php

namespace App\Services;

use App\Models\User;
use App\Services\AuthServiceInterface;

class AuthService implements AuthServiceInterface
{
    public function register($data)
    {
        $user = User::create([
            "name" => $data["name"],
            "email" => $data["email"],
            "password" => bcrypt($data["password"]),
        ]);

        if($user) {
            auth("web")->login($user);
        }

        return redirect(route("home"));
    }

    public function login(array $data)
    {
        if (auth("web")->attempt($data)){
            return redirect(route('home'));
        };
    }


    public function logout()
    {
        auth('web')->logout();
    }
}