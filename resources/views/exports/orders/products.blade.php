<x-report date_start="{{ $date_start }}" date_end="{{ $date_end }}" colspan="4">
    @push('title', 'Productos por entregar')

    <x-slot name="head">
        <th>Productos</th>
        <th>Cantidad suelta</th>
        <th>Cantidad por bolsa</th>
        <th style="text-align: right;">Monto total</th>
    </x-slot>
    @foreach ($data as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->total_individual }}</td>
            <td>{{ $item->total_by_bag }}</td>
            <td style="text-align: right;">{{ 'Bs ' . $item->total_amount }}</td>
        </tr>
    @endforeach
    <x-slot name="footer">
        @php
            $total_amount = 'Bs ' . number_format($data->sum('total_amount'), 1, ',', '.');
        @endphp
        <tr>
            <td colspan="3"></td>
            <td style="text-align: right;">{{ $total_amount }}</td>
        </tr>
    </x-slot>
</x-report>
