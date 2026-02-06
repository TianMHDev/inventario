<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('categorias.index') }}" class="text-gray-400 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h2 class="font-bold text-2xl text-white leading-tight tracking-tight">
                {{ __('Explorando Categoría') }}: {{ $categoria->nombre }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Cabecera de la Categoría -->
            <div
                class="relative bg-gray-900/50 backdrop-blur-xl border border-white/5 rounded-[3rem] overflow-hidden mb-12 shadow-2xl">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-600/20 to-purple-600/20"></div>
                <div class="relative flex flex-col md:flex-row items-center p-8 md:p-12 gap-8">
                    <div
                        class="h-48 w-48 flex-shrink-0 rounded-[2rem] overflow-hidden border-2 border-white/10 shadow-2xl">
                        @if($categoria->imagen)
                            <img src="{{ asset('storage/' . $categoria->imagen) }}" alt="{{ $categoria->nombre }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-800 flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div>
                        <span
                            class="inline-block px-4 py-1.5 rounded-full bg-indigo-500/10 text-indigo-400 text-xs font-black uppercase tracking-widest border border-indigo-500/20 mb-4">
                            Detalles de Categoría
                        </span>
                        <h1 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tighter mb-4">
                            {{ $categoria->nombre }}
                        </h1>
                        <p class="text-gray-400 text-lg max-w-2xl leading-relaxed">
                            {{ $categoria->descripcion ?? 'Esta categoría agrupa productos específicos para tu inventario. No tiene una descripción extendida definida.' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Listado de Productos -->
            <div
                class="bg-gray-900/50 backdrop-blur-xl border border-white/5 overflow-hidden shadow-2xl sm:rounded-[3rem] p-8 md:p-12">
                <div class="flex items-center justify-between mb-10">
                    <h3 class="text-2xl font-black text-white uppercase tracking-tight">
                        Productos en esta Categoría ({{ $categoria->productos->count() }})
                    </h3>
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('productos.create', ['categoria_id' => $categoria->id]) }}"
                            class="inline-flex items-center justify-center px-6 py-3 bg-white/5 hover:bg-white/10 text-white font-bold text-sm uppercase tracking-widest rounded-2xl border border-white/10 transition-all duration-300">
                            Añadir Producto
                        </a>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($categoria->productos as $producto)
                        <div
                            class="group relative bg-gray-950/40 border border-white/5 rounded-[2.5rem] p-6 transition-all duration-300 hover:border-indigo-500/30">
                            <div class="flex items-center gap-4 mb-6">
                                <div class="h-16 w-16 rounded-2xl overflow-hidden border border-white/5">
                                    @if($producto->imagen)
                                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gray-800 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4
                                        class="text-lg font-bold text-white truncate group-hover:text-indigo-400 transition-colors">
                                        {{ $producto->nombre }}
                                    </h4>
                                    <p class="text-sm font-bold text-emerald-400">
                                        ${{ number_format($producto->precio, 2) }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex justify-between items-center bg-white/5 rounded-2xl p-4">
                                <div>
                                    <p class="text-[10px] text-gray-500 uppercase font-black tracking-widest">Stock</p>
                                    <p
                                        class="text-sm font-bold {{ $producto->stock < 10 ? 'text-orange-400' : 'text-gray-300' }}">
                                        {{ $producto->stock }} Unidades
                                    </p>
                                </div>
                                <a href="{{ route('productos.show', $producto->id) }}"
                                    class="p-3 bg-indigo-600 hover:bg-indigo-700 rounded-xl transition-colors">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center">
                            <svg class="w-16 h-16 mx-auto text-gray-800 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <p class="text-gray-600 font-bold uppercase tracking-widest">No hay productos en esta categoría
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>