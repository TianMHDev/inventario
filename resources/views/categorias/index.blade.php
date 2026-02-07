<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-xl text-white leading-tight">
                    {{ __('Categorías') }}
                </h2>
                <p class="text-xs text-gray-400 mt-1">Gestiona los grupos de tus productos</p>
            </div>
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('categorias.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold uppercase tracking-widest rounded-lg transition-all shadow-lg shadow-indigo-500/20">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Nuevo
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Lista compacta -->
            <div class="space-y-3">
                @forelse($categorias as $categoria)
                    <div
                        class="group bg-gray-900/40 border border-white/5 rounded-xl p-3 flex items-center justify-between hover:border-indigo-500/30 transition-all duration-300">
                        <div class="flex items-center space-x-4 overflow-hidden">
                            <!-- Miniatura pequeña -->
                            <div
                                class="h-12 w-12 flex-shrink-0 rounded-lg overflow-hidden bg-gray-800 border border-white/10">
                                @if($categoria->imagen)
                                    <img src="{{ asset('storage/' . $categoria->imagen) }}" alt="{{ $categoria->nombre }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-800">
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <div>
                                <h3 class="text-sm font-bold text-white group-hover:text-indigo-400 transition-colors">
                                    {{ $categoria->nombre }}
                                </h3>
                                <p class="text-gray-500 text-[11px] truncate max-w-xs md:max-w-md">
                                    {{ $categoria->descripcion ?? 'Sin descripción.' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-6">
                            <div class="hidden md:block text-right pr-4">
                                <span
                                    class="text-[10px] font-bold text-indigo-400 uppercase tracking-widest block">Productos</span>
                                <span
                                    class="text-sm font-black text-white px-2 py-0.5 rounded-full border border-indigo-500/20">
                                    {{ $categoria->productos_count ?? $categoria->productos()->count() }}
                                </span>
                            </div>

                            <div class="flex items-center space-x-2">
                                <a href="{{ route('categorias.show', $categoria->id) }}"
                                    class="p-2 text-gray-400 hover:text-white transition-colors" title="Explorar">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>

                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('categorias.edit', $categoria->id) }}"
                                        class="p-2 text-gray-400 hover:text-yellow-500 transition-colors" title="Editar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="py-12 text-center bg-gray-900/20 rounded-2xl border border-dashed border-white/5">
                        <p class="text-gray-600 text-sm font-medium">No hay categorías disponibles</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>