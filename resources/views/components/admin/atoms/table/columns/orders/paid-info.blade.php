@props(['value'])

@php
    $parts = explode(' ', $value);
    $total = $parts[0];
    $paid = $parts[1];

    if ($paid >= $total) {
        $status = 'paid';
        $classes = 'bg-green-500';
        $content = 'Cancelado';
    } else {
        $status = 'not-paid';
        $classes = 'bg-red-600';
        $not_paid = $total - $paid;
        $content = "$not_paid Bs";
    }
@endphp

<div>
    <p {{ $attributes->merge(['class' => "$classes px-2 rounded-full text-white"]) }}>{{ $content }}
    </p>
</div>
