<?php

namespace App\Repositories\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{

    public function register($data)
    {
        $data['password'] = Hash::make($data['password']);
        $user = User::query()
            ->where('email', $data['email'])
            ->where('name', $data['name'])
            ->first();

        if ($user) {
            throw new \DomainException('Usuário já cadastrado.', 400);
        }

        return User::create($data);
    }


}
