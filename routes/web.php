<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\ProductoController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\EditProductoController;
use App\Http\Controllers\Web\ShowProductoController;

Route::get('/', function () {
    return view('welcome');
});

// CRUD Productos usando Controller
Route::get('/productos', [HomeController::class, 'index'])->name('productos.index');
Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
Route::get('/productos/edit', [EditProductoController::class, 'edit'])->name('productos.edit');
Route::get('/productos/show', [ShowProductoController::class, 'show'])->name('productos.show');
