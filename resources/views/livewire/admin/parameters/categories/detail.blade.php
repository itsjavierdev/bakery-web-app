<div class="p-6">
    <livewire:admin.parameters.categories.delete redirect="categorias.index">
        <x-detail-show>
            <div>
                <x-detail-row title="ID">
                    <p>{{ $category->id }}</p>
                </x-detail-row>

                <x-detail-row title="Nombre">
                    <p>{{ $category->name }}</p>
                </x-detail-row>

                <x-detail-row title="Fecha de registro">
                    <x-date-format>{{ $category->created_at }}</x-date-format>
                </x-detail-row>

                <x-detail-row title="Fecha de modificación">
                    <x-date-format>{{ $category->updated_at }}</x-date-format>
                </x-detail-row>
            </div>
            <x-slot name="actions">
                <x-item-actions :actions="$actions" routesPrefix="categories" item_id="{{ $category->id }}" />
            </x-slot>
        </x-detail-show>
</div>
