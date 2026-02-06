<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Services\ProductoService;

class ProductoController extends Controller
{
    protected $productoService;

    /**
     * Constructor para inyectar el servicio de productos.
     */
    public function __construct(ProductoService $productoService)
    {
        $this->productoService = $productoService;
    }

    /**
     * Muestra el formulario para crear un nuevo producto.
     * Recupera todas las categorías para que el usuario pueda elegir una.
     */
    public function create(Request $request)
    {
        // Verifica si el usuario tiene permiso para crear según la Policy
        $this->authorize('create', Producto::class);

        // Obtenemos todas las categorías para el select del formulario.
        $categorias = Categoria::all();

        // Si venimos de una categoría específica, la pre-seleccionamos. (Nuestra mejora)
        $selected_categoria_id = $request->input('categoria_id');

        return view('productos.create', compact('categorias', 'selected_categoria_id'));
    }

    /**
     * Guarda un nuevo producto asociado al usuario actual.
     * Incluye la validación de la categoría y el procesamiento de la imagen.
     */
    public function store(Request $request)
    {
        // Seguridad: Solo usuarios autorizados pueden entrar aquí
        $this->authorize('create', Producto::class);

        // Validación: Aseguramos datos limpios y lógicos.
        $validated = $request->validate([
            'nombre'       => 'required|string|max:255',
            'precio'       => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Validación más robusta del remoto
        ]);

        // Pasamos los datos validados al servicio.
        $this->productoService->crearProducto($validated);

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente con su categoría e imagen.');
    }

    /**
     * LISTADO: Filtra productos según el rol del usuario y términos de búsqueda.
     */
    public function index(Request $request)
    {
        // Verifica permiso de ver la lista
        $this->authorize('viewAny', Producto::class);

        $search = $request->input('search'); // Nuestra mejora de búsqueda
        $productos = $this->productoService->obtenerProductosPorUsuario($search);

        return view('productos.index', compact('productos', 'search'));
    }

    /**
     * DETALLE: Muestra un solo producto si el usuario es dueño o admin.
     */
    public function show($id)
    {
        $producto = $this->productoService->obtenerProductoPorId($id);
        // La Policy decide si puedes ver este registro específico
        $this->authorize('view', $producto);

        return view('productos.show', compact('producto'));
    }

    /**
     * EDICIÓN: Solo el dueño o el admin pueden ver el formulario de edición.
     * Carga las categorías para permitir el cambio.
     */
    public function edit($id)
    {
        $producto = $this->productoService->obtenerProductoPorId($id);
        $this->authorize('update', $producto);

        // Cargamos categorías para que el usuario pueda cambiarla si desea.
        $categorias = Categoria::all();

        return view('productos.edit', compact('producto', 'categorias'));
    }

    /**
     * ACTUALIZACIÓN: Aplica cambios validando permisos y procesando la nueva imagen si existe.
     */
    public function update(Request $request, $id)
    {
        $producto = $this->productoService->obtenerProductoPorId($id);
        $this->authorize('update', $producto);

        $validated = $request->validate([
            'nombre'       => 'required|string|max:255',
            'precio'       => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // El servicio maneja la actualización y el reemplazo de la imagen vieja
        $this->productoService->actualizarProducto($id, $validated);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * ELIMINACIÓN: Solo autorizados pueden borrar registros.
     */
    public function destroy($id)
    {
        $producto = $this->productoService->obtenerProductoPorId($id);
        $this->authorize('delete', $producto);

        // El servicio también elimina el archivo físico de la imagen.
        $this->productoService->eliminarProducto($id);

        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
