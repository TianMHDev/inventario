<?php

use App\Http\Controllers\Web\ProductoController;
use Illuminate\Support\Facades\Route;
use App\Models\Producto;

// Ruta principal que carga la vista de bienvenida de Laravel
Route::get('/', function () {
    return view('welcome');
});

// Grupo de rutas que requieren autenticación
Route::middleware([
    'auth:sanctum',                  // Verifica que el usuario esté autenticado con Sanctum
    config('jetstream.auth_session'), // Maneja la sesión de Jetstream para mayor seguridad
    'verified',                       // Asegura que el correo electrónico esté verificado
])->group(function () {

    // Ruta para el Dashboard (Panel de Control)
    Route::get('/dashboard', function () {
        // Redirigimos directamente al catálogo de productos para un flujo más natural
        return redirect()->route('productos.index');
    })->name('dashboard');

    // Rutas Web de Productos (CRUD completo)
    Route::resource('productos', ProductoController::class);

    // Rutas Web de Categorías (Catálogo y gestión)
    Route::resource('categorias', \App\Http\Controllers\Web\CategoriaController::class);
});
