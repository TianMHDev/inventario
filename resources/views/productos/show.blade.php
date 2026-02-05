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
                {{ __('Detalles del Producto') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-gray-900/50 backdrop-blur-xl border border-white/5 overflow-hidden shadow-2xl sm:rounded-3xl p-8 md:p-12">
                <div class="space-y-8">
                    <div class="flex flex-col md:flex-row gap-8 items-start">
                        <!-- Imagen del Producto -->
                        <div class="w-full md:w-1/3">
                            <div class="relative group">
                                <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                                <div class="relative bg-gray-950 rounded-3xl overflow-hidden border border-white/10 aspect-square flex items-center justify-center">
                                    @if($producto->imagen)
                                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-16 h-16 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Información Principal -->
                        <div class="w-full md:w-2/3 space-y-6">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-white/5 pb-6">
                                <div>
                                    <span class="px-2 py-1 text-[10px] font-bold text-indigo-400 bg-indigo-400/10 border border-indigo-400/20 rounded-md uppercase tracking-widest">
                                        {{ $producto->categoria->nombre ?? 'Sin Categoría' }}
                                    </span>
                                    <h3 class="text-4xl font-black text-white mt-2 uppercase tracking-tight">{{ $producto->nombre }}</h3>
                                </div>
                                <div class="text-left md:text-right">
                                    <span class="text-xs font-bold text-gray-500 uppercase tracking-widest block">Precio</span>
                                    <span class="text-4xl font-black text-emerald-400">${{ number_format($producto->precio, 2) }}</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-gray-950/40 rounded-2xl p-4 border border-white/5">
                                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest block mb-1">Stock</span>
                                    <div class="flex items-baseline space-x-2">
                                        <span class="text-2xl font-bold text-white">{{ $producto->stock }}</span>
                                        <span class="text-xs text-gray-500 uppercase font-black">unid.</span>
                                    </div>
                                    <div class="mt-2 h-1.5 w-full bg-gray-800 rounded-full overflow-hidden">
                                        <div class="h-full {{ $producto->stock < 10 ? 'bg-orange-500' : 'bg-indigo-500' }}"
                                            style="width: {{ min(($producto->stock / 100) * 100, 100) }}%"></div>
                                    </div>
                                </div>
                                <div class="bg-gray-950/40 rounded-2xl p-4 border border-white/5">
                                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest block mb-1">ID</span>
                                    <span class="text-xl font-mono text-indigo-400 font-bold">#{{ str_pad($producto->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            </div>

                            <div class="space-y-2 pt-2 text-[10px] font-bold text-gray-500 uppercase tracking-widest italic">
                                <div>Registro: {{ $producto->created_at->format('d/m/Y H:i') }}</div>
                                <div>Actualizado: {{ $producto->updated_at->format('d/m/Y H:i') }}</div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="pt-8 flex flex-col md:flex-row items-center justify-between gap-4 border-t border-white/5">
                        <a href="{{ route('productos.index') }}"
                            class="group flex items-center text-sm font-bold text-gray-500 hover:text-white uppercase tracking-widest transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2 transition-transform group-hover:-translate-x-1" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Volver al Listado
                        </a>
                        <a href="{{ route('productos.edit', $producto->id) }}"
                            class="w-full md:w-auto inline-flex items-center justify-center px-8 py-4 bg-white/5 border border-white/10 rounded-2xl font-bold text-sm text-white uppercase tracking-widest hover:bg-white/10 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2 text-yellow-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            Editar Producto
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>