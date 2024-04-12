<th scope="col"
    {{ $attributes->merge(['class' => 'capitalize p-2 bg-gray-100 text-neutral-500 opacity-90 cursor-pointer border-x border-gray-300 first:border-s-0 last:border-e-0 [&>*]:uppercase [&>*]:break-words']) }}>
    <div class="flex justify-between items-center">
        {{ $slot }}
    </div>
</th>
