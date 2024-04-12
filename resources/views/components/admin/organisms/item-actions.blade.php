@props(['actions', 'routesPrefix', 'item_id'])

<td>
    <div class="flex flex-row md:gap-2 w-full md:w-auto md:p-2">
        @if (in_array('detail', $actions))
            <x-button-action>
                <a tabindex="-1" href="{{ route($routesPrefix . '.show', [$item_id]) }}">
                    <i class="icon-bars text-2xl text-sky-700"></i>
                </a>
            </x-button-action>
        @endif
        @if (in_array('delivery', $actions))
            <x-button-action>
                <i class="icon-delivery text-2xl text-green-700"></i>
            </x-button-action>
        @endif
        @if (in_array('update', $actions))
            <x-button-action>
                <a tabindex="-1" href="{{ route($routesPrefix . '.edit', [$item_id]) }}">
                    <i class="icon-pen text-2xl text-orange-500"></i>

                </a>
            </x-button-action>
        @endif
        @if (in_array('delete', $actions))
            <x-button-action wire:click="$dispatch('confirmDelete', {id: {{ $item_id }}})">
                <i class="icon-trash text-2xl text-red-700"></i>
            </x-button-action>
        @endif
    </div>
</td>
