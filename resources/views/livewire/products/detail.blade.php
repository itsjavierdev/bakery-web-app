<div class="p-6">
    <x-detail-show>
        <div>
            <x-detail-row title="ID">
                <p>{{ $product->id }}</p>
            </x-detail-row>
            @foreach ($images as $image)
                <x-detail-row title="Imagen">
                    <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->name }}"
                        class="w-32 h-32 object-cover">
                </x-detail-row>
            @endforeach
        </div>
        <x-slot name="actions">
            <x-item-actions :actions="$actions" routesPrefix="productos" item_id="{{ $product->id }}" />
        </x-slot>
    </x-detail-show>
</div>
