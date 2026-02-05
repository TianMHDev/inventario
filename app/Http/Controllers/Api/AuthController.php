<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Services\AuthServices;

class AuthController extends Controller
{
    public function __construct(private AuthServices $authServices) {}
    /**
     * Maneja el inicio de sesión y genera un Token de Sanctum.
     */
    public function login(Request $request)
    {
        // 1. Validamos los datos de entrada
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        // 2. Llamamos al servicio para la lógica de autenticación
        $result = $this->authServices->login(
            $request->only('email', 'password'),
            $request->device_name
        );

        // 3. Si el servicio devuelve null, las credenciales fallaron
        if (! $result) {
            return response()->json([
                'error' => 'Las credenciales proporcionadas son incorrectas.'
            ], 401);
        }

        // 4. Retornamos la respuesta exitosa con el token
        return response()->json([
            'access_token' => $result['token'],
            'token_type' => 'Bearer',
            'user' => $result['user']
        ]);
    }

    /**
     * Cierra la sesión (revoca el token actual).
     */
    public function logout(Request $request)
    {
        // El servicio se encarga de eliminar el token del usuario actual
        $this->authServices->logout();

        return response()->json([
            'message' => 'Sesión cerrada y token eliminado correctamente'
        ]);
    }
}
