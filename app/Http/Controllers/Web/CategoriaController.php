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
        $this->authorize('create', \App\Models\Categoria::class);
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', \App\Models\Categoria::class);

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
        $categoria = $this->categoriaService->buscarPorId($id);
        $this->authorize('update', $categoria);
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $categoria = $this->categoriaService->buscarPorId($id);
        $this->authorize('update', $categoria);

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
        $categoria = $this->categoriaService->buscarPorId($id);
        $this->authorize('delete', $categoria);

        $this->categoriaService->eliminar($id);

        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada con éxito.');
    }
}
