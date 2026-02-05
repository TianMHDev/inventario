<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthServices
{
    /**
     * Intenta autenticar al usuario y generar un token.
     */
    public function login(array $credentials, string $deviceName)
    {
        // Solo intentamos autenticar con email y password
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            $user = Auth::user();

            // Creamos el token usando el nombre del dispositivo proporcionado
            $token = $user->createToken($deviceName)->plainTextToken;

            return [
                'token' => $token,
                'user' => $user,
            ];
        }

        return null;
    }

    /**
     * Revoca el token actual del usuario autenticado.
     */
    public function logout()
    {
        $user = Auth::user();
        if ($user) {
            $user->currentAccessToken()->delete();
            return true;
        }
        return false;
    }
}
