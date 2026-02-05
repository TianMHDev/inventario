<?php

namespace App\Services;

use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class ProductoService
{
    public function crearProducto(array $data)
    {
        $data['user_id'] = Auth::id();

        if (isset($data['imagen']) && $data['imagen'] instanceof \Illuminate\Http\UploadedFile) {
            $data['imagen'] = $this->guardarImagen($data['imagen']);
        }

        return Producto::create($data);
    }

    public function obtenerProductosPorUsuario()
    {
        $user = Auth::user();

        // Cargamos la relación de categoría para mostrarla en el listado
        $query = Producto::with('categoria');

        if ($user->role === 'admin') {
            return $query->paginate(10);
        }

        return $query->where('user_id', $user->id)->paginate(10);
    }

    public function obtenerProductoPorId(int $id)
    {
        return Producto::with('categoria')->findOrFail($id);
    }

    public function actualizarProducto(int $id, array $data)
    {
        $producto = Producto::findOrFail($id);

        if (isset($data['imagen']) && $data['imagen'] instanceof \Illuminate\Http\UploadedFile) {
            // Opcional: Eliminar imagen anterior si existe
            if ($producto->imagen) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($producto->imagen);
            }
            $data['imagen'] = $this->guardarImagen($data['imagen']);
        }

        $producto->update($data);
        return $producto;
    }

    public function eliminarProducto(int $id)
    {
        $producto = Producto::findOrFail($id);
        if ($producto->imagen) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($producto->imagen);
        }
        $producto->delete();
        return $producto;
    }

    /**
     * Guarda una imagen en el disco público.
     */
    protected function guardarImagen($file)
    {
        return $file->store('productos', 'public');
    }
}
