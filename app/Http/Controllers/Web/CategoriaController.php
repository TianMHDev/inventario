<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    protected $categoriaService;

    public function __construct(\App\Services\CategoriaService $categoriaService)
    {
        $this->categoriaService = $categoriaService;
    }

    /**
     * Catálogo de categorías (Vista profesional tipo card).
     */
    public function index()
    {
        // En un sistema real, podrías limitar quién ve las categorías, aquí todos los logueados.
        $categorias = $this->categoriaService->obtenerTodas();
        return view('categorias.index', compact('categorias'));
    }

    public function show($id)
    {
        $categoria = \App\Models\Categoria::with('productos')->findOrFail($id);
        // Mostramos la categoría y sus productos asociados.
        return view('categorias.show', compact('categoria'));
    }

    public function create()
    {
        // Solo administradores pueden crear categorías según el diseño previo.
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('categorias.index')->with('error', 'No tienes permisos.');
        }
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') abort(403);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|max:2048'
        ]);

        $this->categoriaService->crear($request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoría creada con éxito.');
    }

    public function edit($id)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        $categoria = $this->categoriaService->buscarPorId($id);
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') abort(403);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|max:2048'
        ]);

        $this->categoriaService->actualizar($id, $request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada con éxito.');
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'admin') abort(403);

        $this->categoriaService->eliminar($id);

        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada con éxito.');
    }
}
