<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductoController;
use App\Http\Controllers\Api\AuthController;

// --- RUTAS PÚBLICAS ---
// Estas rutas no requieren token de autenticación.
// El cliente envía sus credenciales aquí para obtener un acceso inicial.
Route::post('/login', [AuthController::class, 'login']);

// --- RUTA DE INFORMACIÓN DEL USUARIO ---
// Muestra los datos del usuario autenticado actual.
// El middleware 'auth:sanctum' verifica que el token enviado sea válido.
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// --- RUTAS PROTEGIDAS (GRUPO) ---
// Todas las rutas dentro de este grupo requieren un token válido (Bearer Token).
Route::middleware('auth:sanctum')->group(function () {

    // apiResource crea automáticamente las rutas para CRUD (index, store, show, update, destroy).
    // Ideal para APIs ya que omite las rutas de formularios visuales (create, edit).
    Route::apiResource('productos', ProductoController::class);

    // Ruta para cerrar sesión: invalida el token actual del usuario.
    Route::post('/logout', [AuthController::class, 'logout']);
});
