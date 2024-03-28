<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- ID -->
        <div class="col-span-6 md:col-span-5">
            <x-inputs.label value="ID" />
            <div class=" flex gap-3 items-center bg-gray-100 py-2.5 px-4 rounded-md">
                <p>{{ $state['id'] }}</p>
            </div>
        </div>
        <!-- Role -->
        <div class="col-span-6 md:col-span-5">
            <x-inputs.label value="Rol" />
            <div class=" flex gap-3 items-center bg-gray-100 py-2.5 px-4 rounded-md">
                <p>{{ $state['role']->name }}</p>
            </div>
        </div>
        <!-- Name -->
        <div class="col-span-6 md:col-span-5">
            <x-inputs.label value="Nombre" />
            <x-inputs.text class="mt-1 block w-full" wire:model="state.name" />
            <x-inputs.error for="state.name" class="mt-2" />
        </div>
        <!-- Surname -->
        <div class="col-span-6 md:col-span-5">
            <x-inputs.label value="Apellido" />
            <x-inputs.text class="mt-1 block w-full" wire:model="state.surname" />
            <x-inputs.error for="state.surname" class="mt-2" />
        </div>
        <!-- Phone -->
        <div class="col-span-6 md:col-span-5">
            <x-inputs.label value="Telefono" />
            <x-inputs.text class="mt-1 block w-full" wire:model="state.phone" />
            <x-inputs.error for="state.phone" class="mt-2" />
        </div>
        <!-- Identity card-->
        <div class="col-span-6 md:col-span-5">
            <div class="flex flex-row gap-4">
                <div class="w-full">
                    <x-inputs.label value="Carnet de identidad" />
                    <x-inputs.text wire:model="state.CI_number" />
                    <x-inputs.error for="state.CI_number" />
                </div>
                <div class="w-full">
                    <x-inputs.label value="Extensión" />
                    <x-inputs.select wire:model="state.CI_extension">
                        <option value="">Seleccionar</option>
                        @foreach ($extensions as $extension)
                            <option value="{{ $extension }}">{{ $extension }}</option>
                        @endforeach
                    </x-inputs.select>
                    <x-inputs.error for="state.CI_extension" />
                </div>
            </div>
            <x-inputs.error for="state.CI" />
        </div>
        <!-- Email -->
        <div class="col-span-6 sm:col-span-5">
            <x-inputs.label for="email" value="{{ __('Email') }}" />
            <x-inputs.text id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required
                autocomplete="username" />
            <x-inputs.error for="email" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
