@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-sm text-font-primary']) }}>
    {{ $value ?? $slot }}
</label>
