<?php

namespace App\Services;

use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class ProductoService
{
    /**
     * Crea un nuevo producto procesando la imagen si se proporciona.
     *
     * @param array $data Datos del producto desde el request.
     * @return Producto El producto creado.
     */
    public function crearProducto(array $data)
    {
        // Asignamos el usuario autenticado como dueño del producto.
        $data['user_id'] = Auth::id();

<<<<<<< HEAD
        // Si se envió una imagen, la guardamos en el storage público.
        if (isset($data['imagen']) && $data['imagen'] instanceof \Illuminate\Http\UploadedFile) {
            $path = $data['imagen']->store('productos', 'public');
            $data['imagen'] = $path;
=======
        if (isset($data['imagen']) && $data['imagen'] instanceof \Illuminate\Http\UploadedFile) {
            $data['imagen'] = $this->guardarImagen($data['imagen']);
>>>>>>> b449cff309aa0bf8b7ef4d90a1f3473f742715fb
        }

        return Producto::create($data);
    }

    /**
     * Obtiene los productos paginados dependiendo del rol del usuario y filtros de búsqueda.
     */
    public function obtenerProductosPorUsuario(?string $search = null)
    {
        $user = Auth::user();
        $query = Producto::with('categoria');

<<<<<<< HEAD
        // Filtro de búsqueda por nombre si se proporciona
        if ($search) {
            $query->where('nombre', 'like', "%{$search}%");
        }

        if ($user->role === 'admin') {
            return $query->latest()->paginate(10);
        }

        return $query->where('user_id', $user->id)->latest()->paginate(10);
    }

    /**
     * Busca un producto por ID o falla si no existe.
     */
=======
        // Cargamos la relación de categoría para mostrarla en el listado
        $query = Producto::with('categoria');

        if ($user->role === 'admin') {
            return $query->paginate(10);
        }

        return $query->where('user_id', $user->id)->paginate(10);
    }

>>>>>>> b449cff309aa0bf8b7ef4d90a1f3473f742715fb
    public function obtenerProductoPorId(int $id)
    {
        return Producto::with('categoria')->findOrFail($id);
    }

<<<<<<< HEAD
    /**
     * Actualiza un producto existente, manejando el reemplazo de la imagen.
     */
=======
>>>>>>> b449cff309aa0bf8b7ef4d90a1f3473f742715fb
    public function actualizarProducto(int $id, array $data)
    {
        $producto = Producto::findOrFail($id);

<<<<<<< HEAD
        // Si se sube una nueva imagen, reemplazamos la anterior.
        if (isset($data['imagen']) && $data['imagen'] instanceof \Illuminate\Http\UploadedFile) {
            // Eliminamos la imagen antigua si existe.
            if ($producto->imagen) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($producto->imagen);
            }
            // Guardamos la nueva imagen.
            $path = $data['imagen']->store('productos', 'public');
            $data['imagen'] = $path;
=======
        if (isset($data['imagen']) && $data['imagen'] instanceof \Illuminate\Http\UploadedFile) {
            // Opcional: Eliminar imagen anterior si existe
            if ($producto->imagen) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($producto->imagen);
            }
            $data['imagen'] = $this->guardarImagen($data['imagen']);
>>>>>>> b449cff309aa0bf8b7ef4d90a1f3473f742715fb
        }

        $producto->update($data);
        return $producto;
    }

<<<<<<< HEAD
    /**
     * Elimina un producto y su imagen asociada.
     */
    public function eliminarProducto(int $id)
    {
        $producto = Producto::findOrFail($id);

        // Limpiamos el storage eliminando la imagen.
        if ($producto->imagen) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($producto->imagen);
        }

=======
    public function eliminarProducto(int $id)
    {
        $producto = Producto::findOrFail($id);
        if ($producto->imagen) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($producto->imagen);
        }
>>>>>>> b449cff309aa0bf8b7ef4d90a1f3473f742715fb
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
