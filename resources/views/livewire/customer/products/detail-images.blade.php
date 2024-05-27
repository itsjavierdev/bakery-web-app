<div class="row-span-2 flex justify-center flex-col gap-3 p-5 order-2 md:order-1">
    <div>
        <img class="rounded-md w-full object-cover" src="{{ asset('storage/products/400/' . $selected_image_path) }}"
            alt="">
    </div>
    <div class="flex w-full">
        @if (count($images) > 1)
            @foreach ($images as $image)
                <div class="w-1/4 rounded gap-2 mx-2 first:ms-0 last:me-0"
                    wire:click="selectImage('{{ $image['id'] }}')">
                    <img src="{{ asset('storage/products/400/' . $image['path']) }}"
                        class="w-auto rounded @if ($image['selected']) border-4 border-brown-primary @endif"
                        alt="">
                </div>
            @endforeach
        @endif
    </div>
</div>
