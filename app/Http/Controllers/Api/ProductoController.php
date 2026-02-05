<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductoService;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function __construct(private ProductoService $productoService) {}

    /**
     * Listar todos los productos accesibles para el usuario.
     */
    public function index()
    {
        // Verificamos si el usuario tiene permiso (definido en ProductoPolicy).
        $this->authorize('viewAny', Producto::class);

        // El Servicio centraliza la lógica de "si es admin ve todo, si no solo lo suyo".
        return response()->json($this->productoService->obtenerProductosPorUsuario());
    }

    /**
     * Crear un nuevo producto.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Producto::class);

        // Devolvemos el producto creado en formato JSON.
        return response()->json($this->productoService->crearProducto($request->all()));
    }

    /**
     * Ver un producto específico por su ID.
     */
    public function show(string $id)
    {
        $this->authorize('view', Producto::class);
        return response()->json($this->productoService->obtenerProductoPorId($id));
    }

    /**
     * Actualizar un producto existente.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('update', Producto::class);
        return response()->json($this->productoService->actualizarProducto($id, $request->all()));
    }

    /**
     * Borrar un producto.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete', Producto::class);
        return response()->json($this->productoService->eliminarProducto($id));
    }
}
