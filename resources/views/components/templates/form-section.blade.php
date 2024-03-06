@props(['submit'])
<!--Formularios de perfil-->
<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit="{{ $submit }}">
            <div
                class="px-4 py-5 bg-white sm:p-6  border-2 border-b-0 border-gray-300 {{ isset($actions) ? 'rounded-tl-md rounded-tr-md' : 'rounded-md' }}">
                <div class="grid grid-cols-6 gap-6">
                    {{ $form }}
                </div>
            </div>
            @if (isset($actions))
                <div
                    class="flex items-center justify-end px-4 py-3 bg-gray-50 border-t-2 text-end  border-2 border-gray-300 sm:px-6  rounded-bl-md rounded-br-md">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
