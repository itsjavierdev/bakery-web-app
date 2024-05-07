@props(['title' => ''])

<div {{ $attributes->merge(['class' => 'col-span-6 md:col-span-5']) }}>
    <x-inputs.label value="{{ $title }}" />
    <div class=" flex gap-3 items-center bg-gray-100 py-2.5 mt-2 px-4 rounded-md">
        {{ $icon ?? '' }}
        <p>{{ $slot }}</p>
    </div>
</div>
