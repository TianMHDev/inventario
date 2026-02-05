<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('productos.index') }}" class="text-gray-400 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h2 class="font-bold text-2xl text-white leading-tight tracking-tight">
                {{ __('Editar Producto') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-gray-900/50 backdrop-blur-xl border border-white/5 overflow-hidden shadow-2xl sm:rounded-3xl p-8 md:p-12">
                <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- Campo: Nombre del Producto -->
                    <div class="space-y-2">
                        <label for="nombre" class="text-sm font-bold text-gray-400 uppercase tracking-widest pl-1">
                            Nombre del Producto
                        </label>
                        <input type="text" name="nombre" id="nombre" value="{{ $producto->nombre }}"
                            class="block w-full bg-gray-950/50 border-white/5 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl text-white placeholder-gray-600 transition-all duration-200 py-4 px-6"
                            required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Campo: Precio -->
                        <div class="space-y-2">
                            <label for="precio" class="text-sm font-bold text-gray-400 uppercase tracking-widest pl-1">
                                Precio
                            </label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                                    <span class="text-indigo-400 font-bold">$</span>
                                </div>
                                <input type="number" step="0.01" name="precio" id="precio" value="{{ $producto->precio }}"
                                    class="block w-full pl-12 pr-6 bg-gray-950/50 border-white/5 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl text-white placeholder-gray-600 transition-all duration-200 py-4"
                                    required>
                            </div>
                        </div>

                        <!-- Campo: Stock -->
                        <div class="space-y-2">
                            <label for="stock" class="text-sm font-bold text-gray-400 uppercase tracking-widest pl-1">
                                Stock Actual
                            </label>
                            <input type="number" name="stock" id="stock" value="{{ $producto->stock }}"
                                class="block w-full bg-gray-950/50 border-white/5 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl text-white placeholder-gray-600 transition-all duration-200 py-4 px-6"
                                required>
                        </div>
                    </div>

                    <!-- NUEVOS CAMPOS: Categoría e Imagen -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Selección de Categoría -->
                        <div class="space-y-2">
                            <label for="categoria_id" class="text-sm font-bold text-gray-400 uppercase tracking-widest pl-1">
                                Categoría
                            </label>
                            <select name="categoria_id" id="categoria_id" 
                                class="block w-full bg-gray-950/50 border-white/5 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl text-white transition-all duration-200 py-4 px-6 appearance-none" required>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Subida de Imagen -->
                        <div class="space-y-2">
                            <label for="imagen" class="text-sm font-bold text-gray-400 uppercase tracking-widest pl-1">
                                Nueva Foto (Opcional)
                            </label>
                            <div class="flex flex-col space-y-4">
                                @if($producto->imagen)
                                    <div class="flex items-center space-x-4">
                                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Foto actual" class="w-16 h-16 object-cover rounded-xl border border-white/10">
                                        <span class="text-xs text-gray-500 uppercase font-bold tracking-tighter">Imagen Actual</span>
                                    </div>
                                @endif
                                <input type="file" name="imagen" id="imagen" accept="image/*"
                                    class="block w-full text-sm text-gray-400
                                    file:mr-4 file:py-3 file:px-6
                                    file:rounded-2xl file:border-0
                                    file:text-sm file:font-bold
                                    file:bg-indigo-600 file:text-white
                                    hover:file:bg-indigo-700
                                    bg-gray-950/50 border-white/5 rounded-2xl">
                            </div>
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="pt-6 flex flex-col md:flex-row items-center justify-between gap-4 border-t border-white/5">
                        <a href="{{ route('productos.index') }}"
                            class="text-sm font-bold text-gray-500 hover:text-white uppercase tracking-widest transition-colors duration-200 px-2">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="w-full md:w-auto inline-flex items-center justify-center px-8 py-4 bg-amber-500 border border-transparent rounded-2xl font-bold text-sm text-white uppercase tracking-widest hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all duration-200 shadow-lg shadow-amber-500/25">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Actualizar Producto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>