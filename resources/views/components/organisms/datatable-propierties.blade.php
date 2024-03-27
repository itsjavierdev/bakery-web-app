<div {{ $attributes->merge(['class' => 'flex justify-between flex-col md:flex-row gap-5 pb-4']) }}>
    <div class="flex gap-2">
        <x-show-columns />
        <x-show-entries />
    </div>

    <x-orderby />

    <x-search />
</div>
