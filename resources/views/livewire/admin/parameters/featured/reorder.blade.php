<x-form-template>
    <ul wire:sortable="updateFeaturedOrder" class="flex gap-3 flex-wrap">
        @foreach ($sorted_images as $item)
            <li wire:sortable.item="{{ $item['id'] }}" wire:key="image-{{ $item['id'] }}"
                class="mt-3 relative h-40  aspect-video object-cover rounded overflow-hidden {{ $item['has_filter'] ? 'content-banner' : '' }}">
                <div wire:sortable.handle>
                    <img src="{{ asset('storage/featured/160/' . $item['image']) }}" />
                    @if ($item['title'])
                        <p class="text-xl text-white text-center italic absolute w-full h-full flex items-center justify-center z-50 top-0 left-0 [text-shadow:_0_4px_0_rgb(0_0_0_/_50%)]"
                            style="font-family: 'Caveat', cursive;">
                            {{ $item['title'] }}
                        </p>
                    @endif
                </div>
            </li>
        @endforeach
    </ul>

    <!--Actions-->
    <x-slot name="footer">
        <x-button wire:click="update">
            Actualizar
        </x-button>
        <a href="{{ route('featured.index') }}">
            <x-secondary-button>
                Cancelar
            </x-secondary-button>
        </a>
    </x-slot>
</x-form-template>

@push('links')
    <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Montserrat&family=Varela+Round&display=swap"
        rel="stylesheet">
@endpush


@push('js')
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script>
@endpush
