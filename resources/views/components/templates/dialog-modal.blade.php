@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <header class="text-lg font-medium text-gray-900">
            <h3>
                {{ $title }}
            </h3>
        </header>

        <div class="mt-4 text-sm text-gray-600">
            {{ $content }}
        </div>
    </div>

    <footer class="flex flex-row justify-between px-6 py-4 border-t-2 bg-gray-100 text-end">
        {{ $footer }}
    </footer>
</x-modal>
