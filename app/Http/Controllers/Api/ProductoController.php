<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductoService;
use App\Models\Producto;

class ProductoController extends Controller
{
    use \App\Traits\ApiResponse;

    /**
     * Inyectamos el servicio de productos por el constructor.
     */
    public function __construct(private ProductoService $productoService) {}

    /**
     * Listar todos los productos accesibles para el usuario con su categoría.
     */
    public function index()
    {
        $this->authorize('viewAny', Producto::class);
        $productos = $this->productoService->obtenerProductosPorUsuario();

        // Usamos el Resource Collection para estandarizar la salida de la lista.
        return $this->successResponse(\App\Http\Resources\ProductoResource::collection($productos), 'Productos listados con éxito');
    }

    /**
     * Crear un nuevo producto validando los campos y la imagen.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Producto::class);

        // Validación profesional de campos.
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'precio'       => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen'       => 'nullable|image|max:2048', // Max 2MB
        ]);

        $producto = $this->productoService->crearProducto($request->all());

        return $this->successResponse(new \App\Http\Resources\ProductoResource($producto), 'Producto creado con éxito', 201);
    }

    /**
     * Ver un producto específico por su ID con carga de relaciones.
     */
    public function show($id)
    {
        $this->authorize('viewAny', Producto::class); // O view según política
        $producto = $this->productoService->obtenerProductoPorId($id);

        return $this->successResponse(new \App\Http\Resources\ProductoResource($producto), 'Producto encontrado');
    }

    /**
     * Actualizar un producto existente con validación.
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', Producto::class); // Se necesita pasar el modelo si es por ID en la policy

        $request->validate([
            'nombre'       => 'sometimes|required|string|max:255',
            'precio'       => 'sometimes|required|numeric|min:0',
            'stock'        => 'sometimes|required|integer|min:0',
            'categoria_id' => 'sometimes|required|exists:categorias,id',
            'imagen'       => 'nullable|image|max:2048',
        ]);

        $producto = $this->productoService->actualizarProducto($id, $request->all());

        return $this->successResponse(new \App\Http\Resources\ProductoResource($producto), 'Producto actualizado con éxito');
    }

    /**
     * Borrar un producto y limpiar recursos asociados (imagen).
     */
    public function destroy($id)
    {
        $producto = $this->productoService->obtenerProductoPorId($id);

        $this->authorize('delete', $producto);

        $this->productoService->eliminarProducto($id);

        return $this->successResponse(null, 'Producto eliminado correctamente');
    }
}
