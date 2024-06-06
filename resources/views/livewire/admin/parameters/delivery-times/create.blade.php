<x-form-template>
    <!--Time-->
    <x-inputs.group>
        <x-inputs.label value="Horario" is_required />
        <x-inputs.select wire:model="time">
            <option value="">Seleccionar</option>
            @foreach ($times as $time)
                <option value="{{ $time }}">{{ $time }}</option>
            @endforeach
        </x-inputs.select>
        <x-inputs.error for="time" />
    </x-inputs.group>
    <!--Available for delivery-->
    <x-inputs.group>
        <x-inputs.label>
            <x-inputs.checkbox class="mr-2 mb-0.5" wire:model="for_delivery" />
            <span>Disponible para entrega a domicilio</span>
        </x-inputs.label>
        <x-inputs.error for="for_delivery" />
    </x-inputs.group>
    <!--Actions-->
    <x-slot name="footer">
        <x-button wire:click="save" wire:loading.attr="disabled">
            Crear
        </x-button>
        <a href="{{ route('deliverytimes.index') }}">
            <x-secondary-button>
                Cancelar
            </x-secondary-button>
        </a>
    </x-slot>
</x-form-template>
