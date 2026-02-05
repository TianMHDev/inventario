<?php

namespace App\Services;

use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class ProductoService
{
    public function crearProducto(array $data)
    {
        $data['user_id'] = Auth::id();
        return Producto::create($data);
    }

    public function obtenerProductosPorUsuario()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return Producto::paginate(2);
        }

        return Producto::where('user_id', $user->id)->paginate(2);
    }
    public function obtenerProductoPorId(int $id)
    {
        return Producto::findOrFail($id);
    }
    public function actualizarProducto(int $id, array $data)
    {
        $producto = Producto::findOrFail($id);
        $producto->update($data);
        return $producto;
    }
    public function eliminarProducto(int $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return $producto;
    }
}
