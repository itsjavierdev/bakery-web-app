@props(['value'])

@php
    $parts = explode(' ', $value);
    $total = $parts[0];
    if (count($parts) > 1) {
        $paid = $parts[1];
    } else {
        $paid = 0;
    }
    if ($paid >= $total) {
        $status = 'paid';
        $classes = 'bg-green-500';
        $content = 'Cancelado';
    } else {
        $status = 'not-paid';
        $classes = 'bg-red-500';
        $not_paid = $total - $paid;
        $content = "Bs $not_paid";
    }
@endphp

<div class="shrink-0">
    <p {{ $attributes->merge(['class' => "$classes px-2 rounded-full text-white font-bold "]) }}>
        {{ $content }}
    </p>
</div>
