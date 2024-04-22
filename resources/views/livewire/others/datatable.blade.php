<div>
    <x-datatable-propierties />

    <!--table in large screens-->
    <x-table class="hidden md:block">
        <!--Header with sort-->
        <thead>
            <tr>
                <!--id && created_at column header-->
                @if ($has_id_column || $has_created_at_column)
                    <x-th-filter key="id" sort_by="{{ $sort_by }}" sort_direction="{{ $sort_direction }}">
                        @if ($has_id_column)
                            ID
                        @else
                            Fecha de registro
                        @endif
                    </x-th-filter>
                @endif

                <!--Columns header-->
                @foreach ($this->columns() as $column)
                    @if ($column->key != 'id' && $column->key != 'created_at' && in_array($column->key, $selected_columns))
                        <x-th-filter key="{{ $column->key }}" sort_by="{{ $sort_by }}"
                            sort_direction="{{ $sort_direction }}">
                            {{ $column->label }}
                        </x-th-filter>
                    @endif
                @endforeach

                <!--Actions columns header-->
                @if ($this->actions() ?? false)
                    <x-th class="!cursor-default">Acciones</x-th>
                @endif
            </tr>
        </thead>
        <!--Content-->
        <tbody class="border-t-medium border-gray-300">
            @if (!$this->data()->isEmpty())
                <!--Data-->
                @foreach ($this->data() as $row)
                    <x-tr>
                        <!--id && created data-->
                        @if ($has_id_column || $has_created_at_column)
                            <td class="p-2">
                                <x-columns.id id="{{ $row['id'] }}" created_at="{{ $row['created_at'] }}"
                                    has_id_column="{{ $has_id_column }}"
                                    has_created_at_column="{{ $has_created_at_column }}" />

                            </td>
                        @endif

                        <!--All other data in row-->
                        @foreach ($this->columns() as $column)
                            @if ($column->key != 'id' && $column->key != 'created_at' && in_array($column->key, $selected_columns))
                                <td>
                                    <div class="p-2 flex items-center">
                                        <x-dynamic-component :component="$column->component" :value="$row[$column->key]">
                                        </x-dynamic-component>
                                    </div>
                                </td>
                            @endif
                        @endforeach

                        <!--Actions-->
                        @if ($this->actions() ?? false)
                            @if ($add ?? false)
                                <x-item-actions :actions="['add']" routesPrefix="{{ $this->routesPrefix() }}"
                                    item_id="{{ $row['id'] }}" />
                            @else
                                <x-item-actions :actions="$this->actions()" routesPrefix="{{ $this->routesPrefix() }}"
                                    item_id="{{ $row['id'] }}" />
                            @endif
                        @endif
                    </x-tr>
                @endforeach
            @else
                <!--Empty or not found in filter-->
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
                    <!--id && created_at footer-->
                    @if ($has_id_column || $has_created_at_column)
                        <x-th class="!cursor-default">
                            @if ($has_id_column)
                                ID
                            @else
                                Fecha de registro
                            @endif
                        </x-th>
                    @endif

                    <!--All others column footer-->
                    @foreach ($this->columns() as $column)
                        @if ($column->key != 'id' && $column->key != 'created_at' && in_array($column->key, $selected_columns))
                            <x-th class="!cursor-default">
                                {{ $column->label }}
                            </x-th>
                        @endif
                    @endforeach

                    <!--Actions footer-->
                    @if ($this->actions() ?? false)
                        <x-th class="!cursor-default">Acciones</x-th>
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
                    <!--Header if has id or created_at column-->
                    @if ($has_id_column || $has_created_at_column)
                        <x-slot name="header">
                            <x-columns.id id="{{ $row['id'] }}" created_at="{{ $row['created_at'] }}"
                                has_id_column="{{ $has_id_column }}"
                                has_created_at_column="{{ $has_created_at_column }}" />
                        </x-slot>
                    @endif

                    <!--All other columns show in rows-->
                    @foreach ($this->columns() as $column)
                        @if ($column->key != 'id' && $column->key != 'created_at' && in_array($column->key, $selected_columns))
                            <div>
                                <strong class="text-neutral-600">{{ $column->label }}:</strong>
                                <span> <x-dynamic-component :component="$column->component" :value="$row[$column->key]">
                                    </x-dynamic-component></span>
                            </div>
                        @endif
                    @endforeach

                    <!--Actions-->
                    <x-slot name="footer">
                        @if ($this->actions() ?? false)
                            @if ($add ?? false)
                                <x-item-actions :actions="['add']" routesPrefix="{{ $this->routesPrefix() }}"
                                    item_id="{{ $row['id'] }}" />
                            @else
                                <x-item-actions :actions="$this->actions()" routesPrefix="{{ $this->routesPrefix() }}"
                                    item_id="{{ $row['id'] }}" />
                            @endif
                        @endif
                    </x-slot>
                </x-card-mobile>
            @endforeach
        @else
            <!--Empty or not found in filter-->
            <div class="p-3 text-center">No se encontraron registros</div>
        @endif
    </div>

    <!--Pagination-->
    <div class="pt-3">
        {{ $this->data()->links(data: ['scrollTo' => 'main']) }}
    </div>
</div>
