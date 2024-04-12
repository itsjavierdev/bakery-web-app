@props(['for'])

@error($for)
    <div x-init="$nextTick(() => {
        let errorDiv = document.getElementsByClassName('invalid-feedback')[0];
        if (errorDiv) {
            errorDiv.scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'nearest' });
        }
    })">
        <p {{ $attributes->merge(['class' => 'invalid-feedback text-sm text-red-600']) }}>{{ $message }}</p>
    </div>
@enderror
