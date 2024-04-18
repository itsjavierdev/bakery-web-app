@props(['value'])

@php
    $parts = explode(' ', $value);
    $phone = $parts[0];
    $email = $parts[1];
@endphp

<div>
    <p>{{ $phone }}, <span>{{ $email }}</span></p>
</div>
