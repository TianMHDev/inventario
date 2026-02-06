<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-white leading-tight tracking-tight">
                {{ __('Dashboard de Inventario') }}
            </h2>
            <div class="flex items-center space-x-2 text-sm text-gray-400">
                <span>{{ now()->format('d M, Y') }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 flex items-center p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-xl shadow-lg shadow-emerald-500/5 animate-fade-in"
                    role="alert">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div
                class="bg-gray-900/50 backdrop-blur-xl border border-white/5 overflow-hidden shadow-2xl sm:rounded-3xl p-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
                    <div>
                        <h3 class="text-xl font-black text-white uppercase tracking-tight mb-1">Inventario Global</h3>
                        <p class="text-gray-400 text-sm font-medium">Gestiona tus productos con precisión quirúrgica.
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row w-full md:w-auto gap-4">
                        <!-- Barra de Búsqueda Profesional -->
                        <form action="{{ route('productos.index') }}" method="GET" class="relative group">
                            <input type="text" name="search" value="{{ $search ?? '' }}"
                                placeholder="Buscar producto..."
                                class="w-full sm:w-64 bg-white/5 border-white/10 focus:border-indigo-500 focus:ring-0 rounded-xl text-sm text-white placeholder-gray-500 py-3 pl-12 pr-4 transition-all duration-300 group-hover:bg-white/10">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-500 group-hover:text-indigo-400 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </form>

                        <a href="{{ route('productos.create') }}"
                            class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm uppercase tracking-widest rounded-xl transition-all duration-200 shadow-lg shadow-indigo-500/20 group">
                            <svg class="w-5 h-5 mr-2 transition-transform group-hover:rotate-90" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Nuevo Registro
                        </a>
                    </div>
                </div>

                <!-- Contenedor con scroll horizontal para móviles -->
                <div class="overflow-x-auto bg-gray-950/30 rounded-2xl border border-white/5">
                    <table class="min-w-full divide-y divide-white/5">
                        <thead class="bg-white/[0.02]">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">
                                    Producto</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">
                                    Categoría</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">
                                    Precio</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">
                                    Stock</th>
                                <th
                                    class="px-6 py-4 text-center text-xs font-bold text-gray-400 uppercase tracking-widest">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($productos as $producto)
                                <tr class="hover:bg-white/[0.02] transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <!-- Miniatura de la imagen del producto -->
                                            <div
                                                class="h-12 w-12 flex-shrink-0 rounded-xl overflow-hidden bg-gray-800 border border-white/5 mr-4 shadow-inner">
                                                @if($producto->imagen)
                                                    <img src="{{ asset('storage/' . $producto->imagen) }}"
                                                        alt="{{ $producto->nombre }}" class="h-full w-full object-cover">
                                                @else
                                                    <div class="h-full w-full flex items-center justify-center text-gray-600">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="text-sm font-semibold text-white">{{ $producto->nombre }}</div>
                                                <div class="text-xs text-gray-500 font-mono">ID: {{ $producto->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <!-- Nombre de la categoría limpio (sin el detalle del recuadro) -->
                                        <span class="text-sm font-bold text-indigo-400">
                                            {{ $producto->categoria->nombre ?? 'Sin categoría' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-emerald-400">
                                            ${{ number_format($producto->precio, 2) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span
                                                class="text-sm {{ $producto->stock < 10 ? 'text-orange-400' : 'text-gray-300' }} font-medium">
                                                {{ $producto->stock }}
                                            </span>
                                            @if($producto->stock < 10)
                                                <span class="ml-2 flex h-2 w-2 rounded-full bg-orange-500 animate-pulse"></span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex justify-center items-center space-x-3">
                                            <a href="{{ route('productos.show', $producto->id) }}"
                                                class="flex items-center text-gray-400 hover:text-white transition-colors duration-200"
                                                title="Ver detalle">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <a href="{{ route('productos.edit', $producto->id) }}"
                                                class="flex items-center text-gray-400 hover:text-yellow-400 transition-colors duration-200"
                                                title="Editar">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </a>

                                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST"
                                                onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="flex items-center text-gray-400 hover:text-red-500 transition-colors duration-200"
                                                    title="Eliminar">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-gray-600 mb-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                                                </path>
                                            </svg>
                                            <p class="text-gray-500 font-medium">No hay productos registrados en tu
                                                inventario.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 pagination-dark">
                    {{ $productos->appends(['search' => $search])->links() }}
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.4s ease-out forwards;
        }

        .pagination-dark nav div span,
        .pagination-dark nav div a {
            background-color: transparent !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
            color: #9ca3af !important;
        }

        .pagination-dark nav div span.z-10 {
            background-color: #4f46e5 !important;
            color: white !important;
            border-color: #4f46e5 !important;
        }
    </style>
</x-app-layout>