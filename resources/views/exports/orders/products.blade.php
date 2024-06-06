<x-report date_start="{{ $date_start }}" date_end="{{ $date_end }}" colspan="4">
    @push('title', 'Productos por entregar')

    <x-slot name="head">
        <th>Productos</th>
        <th style="text-align: right;">Cantidad suelta</th>
        <th style="text-align: right;">Cantidad por bolsa</th>
        <th style="text-align: right;">Monto total</th>
    </x-slot>
    @foreach ($data as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td style="text-align: right;">{{ $item->total_individual }}</td>
            <td style="text-align: right;">{{ $item->total_by_bag }}</td>
            <td style="text-align: right;">{{ 'Bs ' . $item->total_amount }}</td>
        </tr>
    @endforeach
    <x-slot name="footer">
        @php
            $total_amount = 'Bs ' . number_format($data->sum('total_amount'), 1, ',', '.');
            $total_individual = $data->sum('total_individual');
            $total_by_bag = $data->sum('total_by_bag');
        @endphp
        <tr>
            <td colspan="1"></td>
            <td style="text-align: right;">{{ $total_individual }}</td>
            <td style="text-align: right;">{{ $total_by_bag }}</td>
            <td style="text-align: right;">{{ $total_amount }}</td>
        </tr>
    </x-slot>
</x-report>
