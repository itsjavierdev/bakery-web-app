@props(['value'])

<div>
    @if ($value)
        <i class="icon-check text-green-500 text-lg"></i>
    @else
        <i class="icon-x text-red-500 text-lg"></i>
    @endif
</div>
