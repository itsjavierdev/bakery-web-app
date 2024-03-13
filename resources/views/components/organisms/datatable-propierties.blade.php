@props(['columns'])

<div {{ $attributes->merge(['class' => 'flex justify-between flex-col md:flex-row gap-5 pb-4']) }}>
    <x-show-entries />

    <x-orderby :columns="$columns" />

    <x-search />
</div>
