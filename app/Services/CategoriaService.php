<?php

namespace App\Services;

use App\Models\Categoria;

/**
 * Servicio para manejar la lógica de negocio de las Categorías.
 */
class CategoriaService
{
    /**
     * Obtener todas las categorías.
     */
    public function obtenerTodas()
    {
        return Categoria::all();
    }

    /**
     * Crear una nueva categoría con imagen opcional.
     */
    public function crear(array $data)
    {
        if (isset($data['imagen']) && $data['imagen'] instanceof \Illuminate\Http\UploadedFile) {
            $data['imagen'] = $data['imagen']->store('categorias', 'public');
        }

        return Categoria::create($data);
    }

    /**
     * Buscar categoría por ID.
     */
    public function buscarPorId(int $id)
    {
        return Categoria::findOrFail($id);
    }

    /**
     * Actualizar categoría manejando el cambio de imagen.
     */
    public function actualizar(int $id, array $data)
    {
        $categoria = Categoria::findOrFail($id);

        if (isset($data['imagen']) && $data['imagen'] instanceof \Illuminate\Http\UploadedFile) {
            if ($categoria->imagen) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($categoria->imagen);
            }
            $data['imagen'] = $data['imagen']->store('categorias', 'public');
        }

        $categoria->update($data);
        return $categoria;
    }

    /**
     * Eliminar categoría y su imagen.
     */
    public function eliminar(int $id)
    {
        $categoria = Categoria::findOrFail($id);

        if ($categoria->imagen) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($categoria->imagen);
        }

        $categoria->delete();
        return $categoria;
    }
}
