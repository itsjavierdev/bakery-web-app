@props(['value'])

<div>
    {{ Carbon\Carbon::parse($value)->isoFormat('DD MMM YYYY') }}
</div>
