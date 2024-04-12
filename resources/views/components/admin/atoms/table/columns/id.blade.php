@props(['id', 'created_at', 'has_id_column', 'has_created_at_column'])

<div>
    <span>
        @if ($has_id_column)
            <strong class="text-blue-600 mr-2">
                #{{ $id }}
            </strong>
        @endif
        @if ($has_created_at_column)
            {{ Carbon\Carbon::parse($created_at)->isoFormat('DD MMM YYYY') }}
        @endif
    </span>
</div>
