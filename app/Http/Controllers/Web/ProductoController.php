<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Services\ProductoService;

class ProductoController extends Controller
{
    protected $productoService;

    public function __construct(ProductoService $productoService)
    {
        $this->productoService = $productoService;
    }
    // Muestra el formulario para crear un nuevo producto
    public function create()
    {
        // Verifica si el usuario tiene permiso para crear según la Policy
        $this->authorize('create', Producto::class);
        return view('productos.create');
    }

    // Guarda un nuevo producto asociado al usuario actual
    public function store(Request $request)
    {
        // Seguridad: Solo usuarios autorizados pueden entrar aquí
        $this->authorize('create', Producto::class);

        // Validación: Aseguramos datos limpios y lógicos
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $this->productoService->crearProducto($validated);
        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    // LISTADO: Filtra productos según el rol del usuario
    public function index()
    {
        // Verifica permiso de ver la lista
        $this->authorize('viewAny', Producto::class);
        $productos = $this->productoService->obtenerProductosPorUsuario();
        return view('productos.index', compact('productos'));
    }

    // DETALLE: Muestra un solo producto si el usuario es dueño o admin
    public function show($id)
    {
        $producto = $this->productoService->obtenerProductoPorId($id);
        // La Policy decide si puedes ver este registro específico
        $this->authorize('view', $producto);

        return view('productos.show', compact('producto'));
    }

    // EDICIÓN: Solo el dueño o el admin pueden ver el formulario de edición
    public function edit($id)
    {
        $producto = $this->productoService->obtenerProductoPorId($id);

        $this->authorize('update', $producto);

        return view('productos.edit', compact('producto'));
    }

    // ACTUALIZACIÓN: Aplica cambios validando permisos de nuevo
    public function update(Request $request, $id)
    {
        $producto = $this->productoService->obtenerProductoPorId($id);

        $this->authorize('update', $producto);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $this->productoService->actualizarProducto($id, $validated);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    // ELIMINACIÓN: Solo autorizados pueden borrar registros
    public function destroy($id)
    {
        $producto = $this->productoService->obtenerProductoPorId($id);

        $this->authorize('delete', $producto);

        $this->productoService->eliminarProducto($id);

        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
