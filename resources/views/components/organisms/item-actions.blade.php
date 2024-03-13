@props(['actions', 'model', 'item_id'])

<td>
    <div class="flex flex-row md:gap-2 w-full md:w-auto md:p-2">
        @if (in_array('detail', $actions))
            <x-button-action color="sky">
                <i class="icon-bars text-2xl"></i>
            </x-button-action>
        @endif
        @if (in_array('delivery', $actions))
            <x-button-action color="green">
                <i class="icon-delivery text-2xl"></i>
            </x-button-action>
        @endif
        @if (in_array('update', $actions))
            <x-button-action color="orange">
                <a href="" tabindex="-1">
                    <i class="icon-pen text-2xl"></i>

                </a>
            </x-button-action>
        @endif
        @if (in_array('delete', $actions))
            <x-button-action color="red">
                <i class="icon-trash text-2xl"></i>
            </x-button-action>
        @endif
    </div>
</td>
