<x-form-template>
    <div class="flex flex-col md:flex-row w-full gap-5 md:gap-10">
        <div class="w-full">
            <h2 class="text-lg text-gray-700 text-center font-medium w-full mb-4">Informacion del personal</h2>
            <!--Name-->
            <x-inputs.group>
                <x-inputs.label value="Nombre" is_required />
                <x-inputs.text wire:model="staff_update.name" />
                <x-inputs.error for="staff_update.name" />
            </x-inputs.group>
            <!--Surname-->
            <x-inputs.group>
                <x-inputs.label value="Apellido" is_required />
                <x-inputs.text wire:model="staff_update.surname" />
                <x-inputs.error for="staff_update.surname" />
            </x-inputs.group>
            <!--Phone-->
            <x-inputs.group>
                <x-inputs.label value="Telefono" is_required />
                <x-inputs.text type="tel" wire:model="staff_update.phone" />
                <x-inputs.error for="staff_update.phone" />
            </x-inputs.group>
            <!--Identity card-->
            <x-inputs.group>
                <div class="flex flex-row gap-4">
                    <div class="w-full">
                        <x-inputs.label value="Carnet de identidad" is_required />
                        <x-inputs.text class="mt-2" wire:model="staff_update.CI_number" />
                        <x-inputs.error for="staff_update.CI_number" />
                    </div>
                    <div class="w-full">
                        <x-inputs.label value="Extensión" is_required />
                        <x-inputs.select class="mt-2" wire:model="staff_update.CI_extension">
                            <option value="">Seleccionar</option>
                            @foreach ($extensions as $extension)
                                <option value="{{ $extension }}">{{ $extension }}</option>
                            @endforeach
                        </x-inputs.select>
                        <x-inputs.error for="staff_update.CI_extension" />
                    </div>
                </div>
                <x-inputs.error for="staff_update.CI" />
            </x-inputs.group>
            <!--Birthdate-->
            <x-inputs.group>
                <x-inputs.label value="Fecha de nacimiento" is_required />
                <x-inputs.date wire:model="staff_update.birthdate" />
                <x-inputs.error for="staff_update.birthdate" />
            </x-inputs.group>
            <!--Is employed-->
            <x-inputs.group>
                <x-inputs.label>
                    <x-inputs.checkbox class="mr-2 mb-0.5" wire:model="staff_update.is_employed" />
                    <span>Empleado en la empresa</span>
                </x-inputs.label>
                <x-inputs.error for="staff_update.is_employed" />
            </x-inputs.group>
        </div>
        <hr class="md:hidden">
        <div class="w-full">
            <!--Add and account button-->
            <div class="flex justify-center mb-1">
                <x-inputs.label class="flex justify-center items-center cursor-pointer gap-1 w-fit">
                    @can('user.create')
                        <!--Change button in add account-->
                        @if (!$has_account)
                            @if ($add_account)
                                <x-button-rounded wire:click="$set('add_account', false)">
                                    <i class="icon-minus text-2xl text-red-700"></i>
                                </x-button-rounded>
                            @else
                                <x-button-rounded wire:click="$set('add_account', true)">
                                    <i class="icon-plus text-2xl text-green-700"></i>
                                </x-button-rounded>
                            @endif
                        @endif
                    @endcan

                    @can('user.delete')
                        @if ($has_account)
                            <div class="w-10"></div>
                        @endif
                    @endcan

                    @if ($has_account)
                        @canany(['user.update', 'user.delete'])
                            <h2 class="text-lg text-gray-700 text-center font-medium py-1">Cuenta en el sistema</h2>
                        @endcanany
                    @else
                        @can('user.create')
                            <h2 class="text-lg text-gray-700 text-center font-medium py-1">Cuenta en el sistema</h2>
                        @endcan
                    @endif

                    @can('user.create')
                        @if (!$has_account)
                            <div class="w-10"></div>
                        @endif
                    @endcan

                    @can('user.delete')
                        <!--Delete account button-->
                        @if ($has_account)
                            <x-dropdown width="">
                                <x-slot name="trigger">
                                    <x-button-rounded tabindex="-1">
                                        <i class="icon-dots text-lg text-gray-700"></i>
                                    </x-button-rounded>
                                </x-slot>
                                <x-slot name="content">
                                    <x-button color="red"
                                        wire:click="$dispatch('confirmDelete', {id: {{ $user_update->user->id }}})">
                                        Eliminar cuenta
                                    </x-button>
                                </x-slot>
                            </x-dropdown>
                            <livewire:admin.management-admin.users.delete redirect="personal.index" />
                        @endif
                    @endcan
                </x-inputs.label>
            </div>

            @can('user.create')

                <!--Account form-->
                @if ($add_account)
                    <!--Role-->
                    <x-inputs.group>
                        <x-inputs.label value="Rol" is_required />
                        <x-inputs.select wire:model="{{ $has_account ? 'user_update.role' : 'user_create.role' }}">
                            <option value="">Seleccionar</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </x-inputs.select>
                        <x-inputs.error for="{{ $has_account ? 'user_update.role' : 'user_create.role' }}" />
                    </x-inputs.group>
                    <!--Email-->
                    <x-inputs.group>
                        <x-inputs.label value="Correo electronico" is_required />
                        <x-inputs.text wire:model="{{ $has_account ? 'user_update.email' : 'user_create.email' }}" />
                        <x-inputs.error for="{{ $has_account ? 'user_update.email' : 'user_create.email' }}" />
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

            @can('user.update')
                @if ($has_account)
                    <!--Role-->
                    <x-inputs.group>
                        <x-inputs.label value="Rol" is_required />
                        <x-inputs.select wire:model="{{ $has_account ? 'user_update.role' : 'user_create.role' }}">
                            <option value="">Seleccionar</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </x-inputs.select>
                        <x-inputs.error for="{{ $has_account ? 'user_update.role' : 'user_create.role' }}" />
                    </x-inputs.group>
                    <!--Email-->
                    <x-inputs.group>
                        <x-inputs.label value="Correo electronico" is_required />
                        <x-inputs.text wire:model="{{ $has_account ? 'user_update.email' : 'user_create.email' }}" />
                        <x-inputs.error for="{{ $has_account ? 'user_update.email' : 'user_create.email' }}" />
                    </x-inputs.group>
                    <!--Is active-->
                    <x-inputs.group>
                        <x-inputs.label>
                            <x-inputs.checkbox class="mr-2 mb-0.5" wire:model="user_update.is_active" />
                            <span>Cuenta activa</span>
                        </x-inputs.label>

                        <x-inputs.error for="user_update.is_active" />
                    </x-inputs.group>
                @endif
            @endcan
        </div>
    </div>

    <!--Actions-->
    <x-slot name="footer">
        <x-button wire:click="update" wire:loading.attr="disabled">
            Actualizar
        </x-button>
        <a href="{{ route('staff.index') }}">
            <x-secondary-button>
                Cancelar
            </x-secondary-button>
        </a>
    </x-slot>
</x-form-template>
