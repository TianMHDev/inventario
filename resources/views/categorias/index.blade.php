<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-white leading-tight tracking-tight">
                {{ __('Catálogo de Categorías') }}
            </h2>
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('categorias.create') }}"
                    class="group relative inline-flex items-center justify-center px-6 py-3 font-bold text-white transition-all duration-200 bg-emerald-600 font-pj rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-600 hover:bg-emerald-700 shadow-lg shadow-emerald-500/20">
                    <svg class="w-5 h-5 mr-2 -ml-1 transition-transform group-hover:scale-110" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Nueva Categoría
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Grid responsiva optimizada -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8">
                @forelse($categorias as $categoria)
                    <div
                        class="group relative bg-gray-900/40 border border-white/5 rounded-[2.5rem] overflow-hidden transition-all duration-500 hover:border-indigo-500/20">
                        <!-- Imagen/Background de la categoría -->
                        <div class="h-44 w-full relative overflow-hidden">
                            @if($categoria->imagen)
                                <img src="{{ asset('storage/' . $categoria->imagen) }}" alt="{{ $categoria->nombre }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @else
                                <div
                                    class="w-full h-full bg-gradient-to-br from-indigo-900/10 to-purple-900/10 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-indigo-500/20" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                    </svg>
                                </div>
                            @endif
                            <!-- Sombra suave sobre la imagen -->
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent opacity-80"></div>
                        </div>

                        <!-- Contenido -->
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <h3
                                    class="text-lg font-black text-white uppercase tracking-tight group-hover:text-indigo-400 transition-colors">
                                    {{ $categoria->nombre }}
                                </h3>
                                <span class="text-[10px] font-black text-indigo-500 px-2 py-1 bg-indigo-500/5 rounded">
                                    {{ $categoria->productos_count ?? $categoria->productos()->count() }}
                                </span>
                            </div>

                            <p class="text-gray-500 text-xs line-clamp-2 mb-6 font-medium">
                                {{ $categoria->descripcion ?? 'Gestiona tus productos de esta categoría de forma eficiente.' }}
                            </p>

                            <div class="flex items-center justify-between">
                                <a href="{{ route('categorias.show', $categoria->id) }}"
                                    class="inline-flex items-center text-[10px] font-black text-white uppercase tracking-widest hover:text-indigo-400 transition-colors">
                                    Explorar
                                    <svg class="w-3 h-3 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>

                                @if(auth()->user()->role === 'admin')
                                    <div class="flex space-x-2">
                                        <a href="{{ route('categorias.edit', $categoria->id) }}"
                                            class="p-2 text-gray-500 hover:text-yellow-500 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full py-20 text-center bg-gray-900/30 rounded-[3rem] border border-dashed border-white/5">
                        <svg class="w-16 h-16 mx-auto text-gray-800 mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <p class="text-gray-600 font-bold uppercase tracking-widest text-sm">No hay categorías registradas
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>