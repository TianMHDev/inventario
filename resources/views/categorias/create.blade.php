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
                {{ __('Crear Nueva Categoría') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-gray-900/50 backdrop-blur-xl border border-white/5 overflow-hidden shadow-2xl sm:rounded-3xl p-8 md:p-12">
                <form action="{{ route('categorias.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-8">
                    @csrf

                    <div class="space-y-2">
                        <label for="nombre"
                            class="text-sm font-bold text-gray-400 uppercase tracking-widest pl-1">Nombre de la
                            Categoría</label>
                        <input type="text" name="nombre" id="nombre"
                            class="block w-full bg-gray-950/50 border-white/5 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl text-white placeholder-gray-600 transition-all duration-200 py-4 px-6"
                            placeholder="Ej: Electrónica" required>
                    </div>

                    <div class="space-y-2">
                        <label for="descripcion"
                            class="text-sm font-bold text-gray-400 uppercase tracking-widest pl-1">Descripción</label>
                        <textarea name="descripcion" id="descripcion" rows="4"
                            class="block w-full bg-gray-950/50 border-white/5 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl text-white placeholder-gray-600 transition-all duration-200 py-4 px-6"
                            placeholder="Describe brevemente esta categoría..."></textarea>
                    </div>

                    <div class="space-y-2">
                        <label for="imagen"
                            class="text-sm font-bold text-gray-400 uppercase tracking-widest pl-1">Imagen de Portada
                            (Opcional)</label>
                        <input type="file" name="imagen" id="imagen" accept="image/*"
                            class="block w-full bg-gray-950/50 border-white/5 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl text-gray-400 file:mr-4 file:py-4 file:px-6 file:rounded-2xl file:border-0 file:text-sm file:font-bold file:bg-white/5 file:text-indigo-400 hover:file:bg-white/10 transition-all duration-200">
                    </div>

                    <div
                        class="pt-6 flex flex-col md:flex-row items-center justify-between gap-4 border-t border-white/5">
                        <a href="{{ route('categorias.index') }}"
                            class="text-sm font-bold text-gray-500 hover:text-white uppercase tracking-widest transition-colors duration-200">Cancelar</a>
                        <button type="submit"
                            class="w-full md:w-auto inline-flex items-center justify-center px-8 py-4 bg-emerald-600 border border-transparent rounded-2xl font-bold text-sm text-white uppercase tracking-widest hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-600 transition-all duration-200 shadow-lg shadow-emerald-500/25">
                            Guardar Categoría
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>