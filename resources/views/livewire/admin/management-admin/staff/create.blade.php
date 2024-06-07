<x-form-template>
    <div class="flex flex-col md:flex-row w-full gap-5 md:gap-10">
        <div class="w-full">
            <h2 class="text-lg text-gray-700 text-center font-medium w-full mb-4">Informacion del personal</h2>
            <!--Name-->
            <x-inputs.group>
                <x-inputs.label value="Nombre" is_required />
                <x-inputs.text wire:model="staff_create.name" />
                <x-inputs.error for="staff_create.name" />
            </x-inputs.group>
            <!--Surname-->
            <x-inputs.group>
                <x-inputs.label value="Apellido" is_required />
                <x-inputs.text wire:model="staff_create.surname" />
                <x-inputs.error for="staff_create.surname" />
            </x-inputs.group>
            <!--Phone-->
            <x-inputs.group>
                <x-inputs.label value="Telefono" is_required />
                <x-inputs.text type="tel" wire:model="staff_create.phone" />
                <x-inputs.error for="staff_create.phone" />
            </x-inputs.group>
            <!--Identity card-->
            <x-inputs.group>
                <div class="flex flex-row gap-4 *:w-full">
                    <div>
                        <x-inputs.label value="Carnet de identidad" is_required />
                        <x-inputs.text class="mt-2" wire:model="staff_create.CI_number" />
                        <x-inputs.error for="staff_create.CI_number" />
                    </div>
                    <div>
                        <x-inputs.label value="Extensión" is_required />
                        <x-inputs.select class="mt-2" wire:model="staff_create.CI_extension">
                            <option value="">Seleccionar</option>
                            @foreach ($extensions as $extension)
                                <option value="{{ $extension }}">{{ $extension }}</option>
                            @endforeach
                        </x-inputs.select>
                        <x-inputs.error for="staff_create.CI_extension" />
                    </div>
                </div>
                <x-inputs.error for="staff_create.CI" />
            </x-inputs.group>
            <!--Birthdate-->
            <x-inputs.group>
                <x-inputs.label value="Fecha de nacimiento" is_required />
                <x-inputs.date wire:model="staff_create.birthdate" />
                <x-inputs.error for="staff_create.birthdate" />
            </x-inputs.group>
            <x-inputs.error for="user_create.staff" />
        </div>
        <hr class="md:hidden">

        <!--Create User Account-->
        <div class="w-full ">
            @can('user.create')
                <!--Add and account button-->
                <div class="flex justify-center mb-1">
                    <x-inputs.label class="flex justify-center items-center cursor-pointer gap-1 w-fit">
                        <!--Change button in add account-->
                        @if ($add_account)
                            <x-button-rounded wire:click="$set('add_account', false)">
                                <i class="icon-minus text-2xl text-red-700"></i>
                            </x-button-rounded>
                        @else
                            <x-button-rounded wire:click="$set('add_account', true)">
                                <i class="icon-plus text-2xl text-green-700"></i>
                            </x-button-rounded>
                        @endif

                        <h2 class="text-lg text-gray-700 text-center font-medium">Cuenta en el sistema</h2>

                        <div class="w-10"></div>
                    </x-inputs.label>
                </div>
                <!--Account form-->
                @if ($add_account)
                    <!--Role-->
                    <x-inputs.group>
                        <x-inputs.label value="Rol" is_required />
                        <x-inputs.select wire:model="user_create.role">
                            <option value="">Seleccionar</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </x-inputs.select>
                        <x-inputs.error for="user_create.role" />
                    </x-inputs.group>
                    <!--Email-->
                    <x-inputs.group>
                        <x-inputs.label value="Correo electronico" is_required />
                        <x-inputs.text wire:model="user_create.email" />
                        <x-inputs.error for="user_create.email" />
                    </x-inputs.group>
                    <!--Password-->
                    <x-inputs.group>
                        <x-inputs.label value="Contraseña" is_required />
                        <x-inputs.text type="password" wire:model="user_create.password" />
                        <x-inputs.error for="user_create.password" />
                    </x-inputs.group>
                    <!--Confirm password-->
                    <x-inputs.group>
                        <x-inputs.label value="Confirmar contraseña" is_required />
                        <x-inputs.text type="password" wire:model="user_create.password_confirmation" />
                        <x-inputs.error for="user_create.password_confirmation" />
                    </x-inputs.group>
                @endif
            @endcan
        </div>
    </div>

    <!--Actions-->
    <x-slot name="footer">
        <x-button wire:click="save" wire:loading.attr="disabled">
            Crear
        </x-button>
        <a href="{{ route('staff.index') }}">
            <x-secondary-button>
                Cancelar
            </x-secondary-button>
        </a>
    </x-slot>
</x-form-template>
