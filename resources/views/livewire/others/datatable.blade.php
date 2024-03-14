<div>
    <x-datatable-propierties :columns="$this->columns()" />

    <x-table>
        <!--Header with sort-->
        <thead>
            <tr>
                @foreach ($this->columns() as $column)
                    <x-th wire:click="sort('{{ $column->key }}')">
                        <h3> {{ $column->label }}</h3>
                        @if ($sort_by === $column->key)
                            @if ($sort_direction == 'asc')
                                <i class="icon-asc float-right text-xl mt-1"></i>
                            @else
                                <i class="icon-sort-desc float-right text-xl mt-1"></i>
                            @endif
                        @else
                            <i class="icon-sort float-right text-xl mt-1"></i>
                        @endif
                    </x-th>
                @endforeach

                @if ($this->actions() ?? false)
                    <x-th>Acciones</x-th>
                @endif
            </tr>
        </thead>
        <!--Content-->
        <tbody class="border-t-medium border-gray-300">
            @if (!$this->data()->isEmpty())
                <!--Data-->
                @foreach ($this->data() as $row)
                    <x-tr>
                        @foreach ($this->columns() as $column)
                            <td>
                                <div class="p-2 flex items-center">
                                    <x-dynamic-component :component="$column->component" :value="$row[$column->key]">
                                    </x-dynamic-component>
                                </div>
                            </td>
                        @endforeach
                        <!--Actions-->
                        @if ($this->actions() ?? false)
                            <x-item-actions :actions="$this->actions()" model="{{ $model }}" item_id="{{ $row['id'] }}" />
                        @endif
                    </x-tr>
                @endforeach
            @else
                <!--Empty-->
                <x-tr>
                    <td class="text-center p-2" colspan="100%">
                        No se encontraron registros
                    </td>
                </x-tr>
            @endif
        </tbody>
        <!--Footer-->
        @if ($this->data()->count() > 10)
            <tfoot class="bg-gray-100 text-neutral-500 border-t-medium border-gray-300">
                <tr>
                    @foreach ($this->columns() as $column)
                        <x-th>
                            {{ $column->label }}
                        </x-th>
                    @endforeach

                    @if ($this->actions() ?? false)
                        <x-th>Acciones</x-th>
                    @endif
                </tr>
            </tfoot>
        @endif
    </x-table>

    <!--Mobile screens-->
    <div class="md:hidden flex flex-col gap-5">
        @if (!$this->data()->isEmpty())
            @foreach ($this->data() as $row)
                <x-card-mobile>
                    <x-slot name="header">
                        <span class="capitalize"><strong class="text-blue-600 mr-1"># {{ $row['id'] }}</strong>
                            {{ $row['created_at']->diffForHumans() }}
                        </span>
                    </x-slot>

                    @foreach ($this->columns() as $column)
                        @if ($column->key == 'id' || $column->key == 'created_at')
                            {{ '' }}
                        @else
                            <div>
                                <strong class="text-neutral-600">{{ $column->label }}:</strong>
                                <span>{{ $row[$column->key] }}</span>
                            </div>
                        @endif
                    @endforeach

                    <x-slot name="footer">
                        @if ($this->actions() ?? false)
                            <x-item-actions :actions="$this->actions()" model="{{ $model }}"
                                item_id="{{ $row['id'] }}" />
                        @endif
                    </x-slot>
                </x-card-mobile>
            @endforeach
        @else
            <!--Empty-->
            <div class="p-3 text-center">No se encontraron registros</div>
        @endif
    </div>
    <div class="pt-3">
        {{ $this->data()->links(data: ['scrollTo' => 'main']) }}
    </div>
</div>
