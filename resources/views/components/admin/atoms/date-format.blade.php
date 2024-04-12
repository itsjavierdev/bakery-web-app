<p {{ $attributes->merge(['class' => '']) }}>
    {{ Carbon\Carbon::parse($slot)->isoFormat('DD MMM YYYY') }}
</p>
