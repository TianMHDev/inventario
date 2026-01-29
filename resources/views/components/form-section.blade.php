@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit="{{ $submit }}">
            <div
                class="px-4 py-5 bg-white dark:bg-gray-900/50 dark:backdrop-blur-xl border border-transparent dark:border-white/5 sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-xl sm:rounded-tr-xl' : 'sm:rounded-xl' }}">
                <div class="grid grid-cols-6 gap-6">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div
                    class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-gray-800/50 border-t border-transparent dark:border-white/5 text-end sm:px-6 shadow sm:rounded-bl-xl sm:rounded-br-xl">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>