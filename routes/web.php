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
        // Obtiene los productos de la base de datos de forma paginada (2 por página)
        $productos = Producto::paginate(2);
        // Retorna la vista 'dashboard' pasando la lista de productos
        return view('dashboard', compact('productos'));
    })->name('dashboard');

    // Genera automáticamente todas las rutas CRUD para productos (index, create, store, edit, etc.)
    // vinculándolas con los métodos correspondientes en el ProductoController
    Route::resource('productos', ProductoController::class);
});
