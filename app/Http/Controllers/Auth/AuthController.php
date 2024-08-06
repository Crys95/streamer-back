<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AuthController extends Controller
{

    public function __construct(
        private readonly AuthRepository $authRepository
    ) {}

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $this->authRepository->register($request->validated());
        }catch (\Exception $e) {
            return Utils::exceptionReturn($e);
        }

        return response()->json([
            'message' => 'Usuário cadastrado com sucesso.'
        ], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $credentials = $request->validated();
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Email ou senha invalidos.'
                ], 401);
            }


            $token = auth()->user()->createToken('authToken')->plainTextToken;
        }catch (\Exception $e) {
            return Utils::exceptionReturn($e);
        }

        return response()->json([
            'message' => 'Usuário logado com sucesso.',
            'token' => $token,
        ]);
    }

    public function logout(): JsonResponse
    {
        try {
            Auth::user()->currentAccessToken()->delete();
        }catch (\Exception $e) {
            return Utils::exceptionReturn($e);
        }

        return response()->json([
            'message' => 'Usuário deslogado com sucesso.'
        ]);

    }
}
