<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CategoriaService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Resources\CategoriaResource;

/**
 * Controlador de API para la gestión de categorías.
 */
class CategoriaController extends Controller
{
    use ApiResponse;

    public function __construct(private CategoriaService $categoriaService) {}

    /**
     * Listar todas las categorías.
     */
    public function index()
    {
        $categorias = $this->categoriaService->obtenerTodas();
        return $this->successResponse(CategoriaResource::collection($categorias), 'Categorías recuperadas con éxito');
    }

    /**
     * Crear una nueva categoría.
     */
    public function store(Request $request)
    {
        $this->authorize('create', \App\Models\Categoria::class);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|max:2048'
        ]);

        $categoria = $this->categoriaService->crear($request->all());
        return $this->successResponse(new CategoriaResource($categoria), 'Categoría creada con éxito', 201);
    }

    /**
     * Mostrar una categoría específica.
     */
    public function show($id)
    {
        $categoria = $this->categoriaService->buscarPorId($id);
        $this->authorize('view', $categoria);
        return $this->successResponse(new CategoriaResource($categoria), 'Categoría encontrada');
    }

    /**
     * Actualizar una categoría.
     */
    public function update(Request $request, $id)
    {
        $categoria = $this->categoriaService->buscarPorId($id);
        $this->authorize('update', $categoria);

        $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|max:2048'
        ]);

        $categoria = $this->categoriaService->actualizar($id, $request->all());
        return $this->successResponse(new CategoriaResource($categoria), 'Categoría actualizada con éxito');
    }

    /**
     * Eliminar una categoría.
     */
    public function destroy($id)
    {
        $categoria = $this->categoriaService->buscarPorId($id);
        $this->authorize('delete', $categoria);

        $this->categoriaService->eliminar($id);
        return $this->successResponse(null, 'Categoría eliminada con éxito');
    }
}
