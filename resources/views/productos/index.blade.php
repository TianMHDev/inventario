<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-white leading-tight tracking-tight">
                {{ __('Gestión de Inventario') }}
            </h2>
            <div class="flex items-center space-x-2 text-sm text-gray-400">
                <span>{{ now()->format('d M, Y') }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Mensajes de éxito con diseño moderno --}}
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
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                    <div>
                        <h3 class="text-xl font-bold text-white mb-1">Productos Disponibles</h3>
                        <p class="text-gray-400 text-sm">Administra el stock y detalles de tus productos.</p>
                    </div>
                    <a href="{{ route('productos.create') }}"
                        class="group relative inline-flex items-center justify-center px-6 py-3 font-bold text-white transition-all duration-200 bg-indigo-600 font-pj rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 hover:bg-indigo-700 shadow-lg shadow-indigo-500/20">
                        <svg class="w-5 h-5 mr-2 -ml-1 transition-transform group-hover:scale-110" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Nuevo Producto
                    </a>
                </div>

                <div class="overflow-hidden bg-gray-950/30 rounded-2xl border border-white/5">
                    <table class="min-w-full divide-y divide-white/5">
                        <thead class="bg-white/[0.02]">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">
                                    ID</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">
                                    Nombre</th>
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
                                        <span
                                            class="text-sm font-mono text-indigo-400 bg-indigo-400/10 px-2 py-1 rounded-md">{{ $producto->id }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-white">{{ $producto->nombre }}</div>
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
                    {{ $productos->links() }}
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