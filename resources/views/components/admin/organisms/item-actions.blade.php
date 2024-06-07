@props(['actions', 'routesPrefix', 'item_id'])

@php
    $update_permission = $routesPrefix . '.update';
    $delete_permission = $routesPrefix . '.delete';
    $delivery_permission = $routesPrefix . '.delivery';
@endphp

<td>
    <div class="flex flex-row md:gap-2 w-full md:w-auto md:p-2">
        @if (in_array('detail', $actions))
            <x-button-action>
                <a tabindex="-1" href="{{ route($routesPrefix . '.show', [$item_id]) }}">
                    <i class="icon-bars text-2xl text-sky-700"></i>
                </a>
            </x-button-action>
        @endif

        @can('debts.add')
            @if (in_array('add-payments', $actions))
                <x-button-action>
                    <a tabindex="-1" href="{{ route('debts.add', [$item_id]) }}">
                        <i class="icon-money-mark text-2xl text-green-700"></i>
                    </a>
                </x-button-action>
            @endif
        @endcan

        @can('orders.delivery')
            @if (in_array('delivery', $actions))
                <x-button-action wire:click="$dispatch('delivery', {id:{{ $item_id }}})">
                    <i class="icon-delivery text-2xl text-green-700"></i>
                </x-button-action>
            @endif
        @endcan

        @can($update_permission)
            @if (in_array('update', $actions))
                <x-button-action>
                    <a tabindex="-1" href="{{ route($routesPrefix . '.edit', [$item_id]) }}">
                        <i class="icon-pen text-2xl text-orange-500"></i>

                    </a>
                </x-button-action>
            @endif
        @endcan

        @can($delete_permission)
            @if (in_array('delete', $actions))
                <x-button-action wire:click="$dispatch('confirmDelete', {id: {{ $item_id }}})">
                    <i class="icon-trash text-2xl text-red-700"></i>
                </x-button-action>
            @endif
        @endcan

        @if (in_array('add', $actions))
            <x-button-action wire:click="$dispatch('add-{{ $routesPrefix }}', {id: {{ $item_id }}})">
                <i class="icon-plus text-2xl text-blue-700"></i>
            </x-button-action>
        @endif

    </div>
</td>
