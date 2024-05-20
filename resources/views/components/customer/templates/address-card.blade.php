@props(['address'])

<div class="mb-4 w-full px-2 flex flex-col md:w-1/2 xl:w-1/3">
    <div class="bg-white rounded p-4 h-full">
        <div class="mb-3 flex">
            <div class="w-1/4 pe-1 ">
                <x-customer-button size="small" variant="secondary" class="text-[9px] justify-center w-full"
                    wire:click="$dispatch('edit-mode', {id:{{ $address->id }}})">Editar</x-customer-button>
            </div>
            <!--Actions-->
            @if ($address->is_active)
                <div class="w-2/4 ">
                    <x-customer-button size="small" wire:click="$dispatch('select-address', {id:{{ $address->id }}})"
                        class="text-[9px] justify-center w-full">Seleccionada</x-customer-button>
                </div>
            @else
                <div class="w-2/4">
                    <x-customer-button size="small" variant="secondary"
                        wire:click="$dispatch('select-address', {id:{{ $address->id }}})"
                        class="text-[9px] justify-center w-full">Seleccionar</x-customer-button>
                </div>
            @endif
            <div class="w-1/4 ps-1 ">
                <x-customer-button size="small" variant="secondary" class="text-[9px] w-full"
                    wire:click="$dispatch('confirmDelete', {id: {{ $address->id }}})">eliminar</x-customer-button>
            </div>
        </div>
        <!--Information-->
        <div class="flex flex-col gap-3 bg-yellow-secondary p-3">
            <span class="font-bold">{{ $address->alias }}</span>
            <span class="font-thin">{{ $address->address }},
                <span>{{ $address->reference }}</span></span>
            <span class="font-thin">{{ $address->city }}</span>
        </div>
    </div>
</div>
