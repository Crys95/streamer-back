<?php

namespace App\Repositories\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class AuthRepository
{

    public function register($data)
    {
        $user = User::query()
            ->where('email', $data['email'])
            ->where('name', $data['name'])
            ->first();

        if ($user) {
            throw new \DomainException('Usuário já cadastrado.', 400);
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'identify' => (string) Str::uuid(),
        ]);
    }


}
