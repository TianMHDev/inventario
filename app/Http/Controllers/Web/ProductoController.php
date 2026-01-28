<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Muestra el formulario para crear un nuevo producto
    public function create()
    {
        return view('productos.create');
    }

    // Guarda un nuevo producto en la base de datos
    public function store(Request $request)
    {
        // Validamos que los datos del formulario cumplan con los requisitos
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        // Crea el registro usando los datos validados
        Producto::create($request->all());

        // Redirige a la lista con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    // Muestra la lista de productos con paginación
    public function index()
    {
        // Recuperamos los productos de 2 en 2 (paginados)
        $productos = Producto::paginate(2);

        // Retornamos la vista 'index' pasando la variable $productos
        return view('productos.index', compact('productos'));
    }

    // Muestra los detalles de un solo producto
    public function show($id)
    {
        // Busca el producto por ID, si no existe lanza un error 404
        $producto = Producto::findOrFail($id);

        return view('productos.show', compact('producto'));
    }

    // Muestra el formulario para editar un producto
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);

        return view('productos.edit', compact('producto'));
    }

    // Actualiza los datos de un producto en la base de datos
    public function update(Request $request, $id)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        // Buscamos el producto y lo actualizamos con los nuevos datos
        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    // Elimina un producto de la base de datos
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete(); // Borrado físico del registro

        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
