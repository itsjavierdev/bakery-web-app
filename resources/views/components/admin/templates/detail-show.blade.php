<div class=" border-medium border-gray-300 rounded-lg overflow-hidden">
    {{ $slot }}
    <div class="flex justify-end border-t-medium border-gray-300 bg-gray-100">
        {{ $actions ?? '' }}
    </div>
</div>
