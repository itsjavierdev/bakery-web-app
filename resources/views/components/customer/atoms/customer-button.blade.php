@props(['size' => 'large', 'variant' => 'primary'])

@php
    switch ($size) {
        case 'large':
            $classSize = 'px-4 py-2 h-[58px] text-base';
            break;

        case 'medium':
            $classSize = 'px-4 py-2 h-[45px] text-xs';
            break;

        case 'small':
            $classSize = 'px-4 py-2 h-9 text-xs';
            break;

        default:
            $classSize = 'px-4 py-2 h-[58px] text-base';
            break;
    }

    switch ($variant) {
        case 'primary':
            $classVariant = 'bg-brown-primary text-white';
            break;

        case 'secondary':
            $classVariant = 'bg-transparent text-brown-primary border-medium border-brown-primary ';
            break;

        default:
            $classVariant = 'bg-brown-primary text-white';
            break;
    }
@endphp

<button
    {{ $attributes->merge(['type' => 'submit', 'class' => "inline-flex items-center justify-center px-4 py-2 h-14 rounded font-semibold  uppercase tracking-widest  focus:bg-opacity-95 focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-brown-primary active:bg-opacity-95 ransition ease-in-out duration-150 $classSize $classVariant"]) }}>
    {{ $slot }}
</button>
