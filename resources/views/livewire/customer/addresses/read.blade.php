<div>
    <div class="flex flex-wrap">
        @foreach ($addresses as $address)
            <x-address-card :address="$address"></x-address-card>
        @endforeach
    </div>
</div>
