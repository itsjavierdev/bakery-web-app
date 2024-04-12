@props(['value'])

<div>
    {{ Carbon\Carbon::createFromFormat('H:i:s', $value)->format('h:i') }}
</div>
