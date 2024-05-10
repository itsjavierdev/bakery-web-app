<x-form-template>
    <!--Time-->
    <x-inputs.group>
        <x-inputs.label value="Horario" />
        <x-inputs.select wire:model="time">
            <option value="">Seleccionar</option>
            @foreach ($times as $time)
                <option value="{{ $time }}">{{ $time }}</option>
            @endforeach
        </x-inputs.select>
        <x-inputs.error for="time" />
    </x-inputs.group>
    <!--Available-->
    <x-inputs.group>
        <x-inputs.label>
            <x-inputs.checkbox class="mr-2 mb-0.5" wire:model="available" />
            <span>Disponible para entrega a domicilio</span>
        </x-inputs.label>
        <x-inputs.error for="available" />
    </x-inputs.group>
    <!--Actions-->
    <x-slot name="footer">
        <x-button wire:click="update" wire:loading.attr="disabled">
            Actualizar
        </x-button>
        <a href="{{ route('deliverytimes.index') }}">
            <x-secondary-button>
                Cancelar
            </x-secondary-button>
        </a>
    </x-slot>
</x-form-template>
