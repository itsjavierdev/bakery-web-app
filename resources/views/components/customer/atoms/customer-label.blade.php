@props(['value', 'is_required' => false])


<div class="flex gap-2">
    <label {{ $attributes->merge(['class' => 'block font-medium text-sm text-font-primary']) }}>
        {{ $value ?? $slot }}
    </label>
    @if ($value ?? true)
        @if ($is_required)
            <span class="text-red-500 text">*</span>
        @endif
    @endif
</div>
