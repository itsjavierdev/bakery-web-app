<div {{ $attributes->merge(['class' => 'rounded-md border-medium border-gray-300 overflow-x-auto']) }}>
    <table class="w-full">
        {{ $slot }}
    </table>
</div>
