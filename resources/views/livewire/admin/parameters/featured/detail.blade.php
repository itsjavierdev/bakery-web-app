<div class="p-6">
    <livewire:admin.parameters.featured.delete redirect="featured.index" />
    <x-detail-show>
        <div>
            <x-detail-row title="ID">
                <p>{{ $featured->id }}</p>
            </x-detail-row>
            @if ($featured->product_id)
                <x-detail-row title="Producto">
                    <p>{{ $product->name }}</p>
                </x-detail-row>
            @endif
            <x-detail-row title="Se muestra">
                @if ($featured->is_active)
                    <i class="icon-check text-green-500 text-lg"></i>
                @else
                    <i class="icon-x text-red-500 text-lg"></i>
                @endif
            </x-detail-row>

            <x-detail-row title="Posición">
                <p>{{ $featured->position }}</p>
            </x-detail-row>
            <div
                class="m-4 md:m-10 relative rounded-lg overflow-hidden {{ $featured->has_filter ? 'content-banner' : '' }}">
                <img src="{{ asset('storage/featured/720/' . $featured->image) }}"
                    class="w-full aspect-video object-cover rounded " />
                @if ($featured->title)
                    <p class="text-6xl text-white text-center absolute w-full h-full flex items-center justify-center z-50 top-0 left-0 [text-shadow:_0_1px_0_rgb(0_0_0_/_50%)]"
                        style="font-family: 'Caveat', cursive;">
                        {{ $featured->title }}
                    </p>
                @endif
            </div>
        </div>
        <x-slot name="actions">
            <x-item-actions :actions="$actions" routesPrefix="featured" item_id="{{ $featured->id }}" />
        </x-slot>
    </x-detail-show>
</div>

@push('links')
    <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Montserrat&family=Varela+Round&display=swap"
        rel="stylesheet">
@endpush
