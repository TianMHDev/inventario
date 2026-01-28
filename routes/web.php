<?php

use App\Http\Controllers\Web\ProductoController;
use Illuminate\Support\Facades\Route;

// Ruta principal que carga la vista de bienvenida de Laravel
Route::get('/', function () {
    return view('welcome');
});

// --- CRUD de Productos ---
// Estas rutas conectan las URLs del navegador con las funciones del ProductoController

// Lista todos los productos (Página principal del dashboard)
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');

// Muestra el formulario para crear un nuevo producto
Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');

// Recibe los datos del formulario de creación y los guarda en la base de datos
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');

// Muestra los detalles de un producto específico según su ID
Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('productos.show');

// Muestra el formulario para editar un producto existente
Route::get('/productos/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');

// Recibe los datos del formulario de edición y actualiza el producto en la BD
Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');

// Elimina un producto de la base de datos
Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');
