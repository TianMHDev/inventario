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

        // Si se envió una imagen, la guardamos en el storage público.
        if (isset($data['imagen']) && $data['imagen'] instanceof \Illuminate\Http\UploadedFile) {
            $path = $data['imagen']->store('productos', 'public');
            $data['imagen'] = $path;
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
    public function obtenerProductoPorId(int $id)
    {
        return Producto::with('categoria')->findOrFail($id);
    }

    /**
     * Actualiza un producto existente, manejando el reemplazo de la imagen.
     */
    public function actualizarProducto(int $id, array $data)
    {
        $producto = Producto::findOrFail($id);

        // Si se sube una nueva imagen, reemplazamos la anterior.
        if (isset($data['imagen']) && $data['imagen'] instanceof \Illuminate\Http\UploadedFile) {
            // Eliminamos la imagen antigua si existe.
            if ($producto->imagen) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($producto->imagen);
            }
            // Guardamos la nueva imagen.
            $path = $data['imagen']->store('productos', 'public');
            $data['imagen'] = $path;
        }

        $producto->update($data);
        return $producto;
    }

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

        $producto->delete();
        return $producto;
    }
}
