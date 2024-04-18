@props(['value'])

@php
    $parts = explode(' ', $value);
    $date = Carbon\Carbon::parse($parts[0])->isoFormat('DD MMM YYYY');
    $time = Carbon\Carbon::createFromFormat('H:i:s', $parts[1])->format('h:i');
@endphp

<div>
    <p>{{ $date }}, <span>{{ $time }}</span></p>
</div>
