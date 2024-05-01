<div>
    <x-dropdown width="w-48">
        <x-slot name="trigger">
            <x-secondary-button class="!px-8 !py-3">
                Reportes
            </x-secondary-button>
        </x-slot>
        <x-slot name="content">
            <x-dropdown-button wire:click="toggleModal('AllSales')">
                Todas las ventas
            </x-dropdown-button>

            <x-dropdown-button wire:click="toggleModal('ByProducts')">
                Ventas por productos
            </x-dropdown-button>

            <x-dropdown-button wire:click="toggleModal('ByCategories')">
                Ventas por categorías
            </x-dropdown-button>

            <x-dropdown-button wire:click="toggleModal('ByStaff')">
                Ventas por personal
            </x-dropdown-button>

            <x-dropdown-button wire:click="toggleModal('ByCustomers')">
                Ventas por clientes
            </x-dropdown-button>
        </x-slot>
    </x-dropdown>
    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            {{ $modal_title }}
        </x-slot>
        <x-slot name="content">
            <!--Time-->
            <x-inputs.group>
                <x-inputs.label value="Periodo:" class="!font-bold" />
                <div class="flex flex-row gap-4 *:w-full">
                    <!--Start-->
                    <div>
                        <x-inputs.label value="Desde" />
                        <x-inputs.date class="mt-2" wire:model="date_start" />
                        <x-inputs.error for="date_start" />
                    </div>
                    <!--End-->
                    <div>
                        <x-inputs.label value="hasta" />
                        <x-inputs.date class="mt-2" wire:model="date_end" />
                        <x-inputs.error for="date_end" />
                    </div>
                </div>
                <x-inputs.error for="name" />
            </x-inputs.group>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="toggleModal('')">
                Cancelar
            </x-secondary-button>
            <div>
                <x-button color="red" class="!px-7" wire:click="export{{ $select }}('pdf')">
                    PDF
                </x-button>
                <x-button color="green" wire:click="export{{ $select }}('xlsx')">
                    Excel
                </x-button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
