<?php

use App\Http\Controllers\Web\ProductoController;
use Illuminate\Support\Facades\Route;
use App\Models\Producto;

// Ruta principal que carga la vista de bienvenida de Laravel
Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $productos = Producto::paginate(2);
        return view('dashboard', compact('productos'));
    })->name('dashboard');
    Route::resource('productos', ProductoController::class);
});
