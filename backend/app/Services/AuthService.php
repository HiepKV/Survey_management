<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
class AuthService
{
    public function login(array $credentials): ?array
    {
        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return null;
        }
        Log::info('Logged in user', ['user' => Auth::guard('api')->user()]);

        return [
            'user' => Auth::user(),
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
        ];
    }

    public function logout(): void
    {
        Auth::guard('api')->logout();
    }

    public function me()
    {
        return Auth::guard('api')->user();
    }
}
