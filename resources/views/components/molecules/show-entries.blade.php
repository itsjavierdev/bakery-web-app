<div {{ $attributes->merge(['class' => 'w-full md:w-auto flex items-center gap-3']) }}>
    <x-inputs.select wire:model.change="per_page">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </x-inputs.select>
</div>
