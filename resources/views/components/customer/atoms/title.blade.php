@props(['txtsize' => '3xl'])

<div {{ $attributes->merge(['class' => 'mb-5']) }}>
    <h1 class="text-brown-primary uppercase text-center tracking-wider font-semibold text-{{ $txtsize }} mb-2">
        {{ $slot }}</h1>
    <hr class="bg-brown-primary border-brown-primary w-16 border h-0.5 mx-auto rounded">
</div>
