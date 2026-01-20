<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/productos', function () {
    return "esto es una prueba";

})->name('productos.index');

//obtener producto por id
Route::get('/prodcutos/{id}', function ($id) {
    return "esto es una prueba" . $id;

})->name('productos.show');

//mostrar formulario para crear producto
Route::get('/productos/create', function () {
    return "esto es una prueba";

})->name('productos.create');

//crear producto
Route::post('/productos',function(){
    return "esto es una prueba";
})->name('productos.store');

//muestre el fomulario para editar un producto
Route::get('/productos/{id}/edit',function($id){
    return "esto es una prueba" . $id;
})->name('productos.edit');

//actualizar un producto
Route::put('/productos/{id}',function($id){
    return "esto es una prueba" . $id;
})->name('productos.update');

//eliminar un producto
Route::delete('/productos/{id}',function($id){
    return "esto es una prueba" . $id;
})->name('productos.destroy');
