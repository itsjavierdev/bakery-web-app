<div class="p-6">
    <livewire:admin.parameters.products.delete redirect="products.index" />
    <x-detail-show>
        <div>
            <x-detail-row title="ID">
                <p>{{ $product->id }}</p>
            </x-detail-row>
            <x-detail-row title="Nombre">
                <p>{{ $product->name }}</p>
            </x-detail-row>
            <x-detail-row title="Precio">
                <p>{{ $product->price }}</p>
            </x-detail-row>
            <x-detail-row title="Cantidad por bolsa">
                <p>{{ $product->bag_quantity }}</p>
            </x-detail-row>
            <x-detail-row title="Vigente">
                <x-columns.inverted-boolean value="{{ $product->discontinued }}" />
            </x-detail-row>
            <x-detail-row isResponsive title="Descripción">
                <p>{{ $product->description }}</p>
            </x-detail-row>
            <x-detail-row title="Slug">
                <p>{{ $product->slug }}</p>
            </x-detail-row>
            <x-detail-row title="Categoría">
                <p>{{ $product->category->name }}</p>
            </x-detail-row>
            <x-detail-row title="Imagenes" classContent="flex flex-wrap gap-4">
                @foreach ($images as $image)
                    <img src="{{ asset('storage/products/128/' . $image->path) }}" alt="{{ $image->name }}"
                        class="w-32 h-32 object-cover rounded ">
                @endforeach
            </x-detail-row>
            <x-detail-row title="Fecha de registro">
                <x-date-format>{{ $product->created_at }}</x-date-format>
            </x-detail-row>
            <x-detail-row title="Fecha de modificación">
                <x-date-format>{{ $product->updated_at }}</x-date-format>
            </x-detail-row>

        </div>
        <x-slot name="actions">
            <x-item-actions :actions="$actions" routesPrefix="products" item_id="{{ $product->id }}" />
        </x-slot>
    </x-detail-show>
</div>
