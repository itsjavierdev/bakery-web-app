@props(['disabled' => false])

<div class="relative">
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
        'class' =>
            'w-full bg-transparent text-brown-primary rounded border-2 border-border focus:border-border focus:ring-white pl-10 pr-6 placeholder-brown-primary',
    ]) !!} type="text" placeholder="Buscar">

    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <i class="icon-search text-xl"></i>
    </div>
</div>
