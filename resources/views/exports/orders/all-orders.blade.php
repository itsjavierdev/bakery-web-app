<x-report date_start="{{ $date_start }}" date_end="{{ $date_end }}" colspan="7">
    @push('title', 'Pedidos por entregar')

    <x-slot name="head">
        <th>ID</th>
        <th>Fecha entrega</th>
        <th>Hora entrega</th>
        <th>Dirección</th>
        <th>Cliente</th>
        <th style="text-align: right;">Monto</th>
        <th style="text-align: right;">Cantidad de productos</th>
    </x-slot>
    @foreach ($data as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ date('d/m/Y', strtotime($item->delivery_date)) }}</td>
            <td>{{ date('H:i', strtotime($item->time)) }}</td>
            <td>{{ $item->address }}</td>
            <td>{{ $item->customer->name . ' ' . $item->customer->surname }}</td>
            <td style="text-align: right;">{{ $item->total }}</td>
            <td style="text-align: right;">{{ $item->total_quantity }}</td>
        </tr>
    @endforeach
    <x-slot name="footer">
        @php
            $total_amount = 'Bs ' . number_format($data->sum('total'), 1, ',', '.');
            $total_quantity = $data->sum('total_quantity');
        @endphp
        <tr>
            <td colspan="5"></td>
            <td style="text-align: right;">{{ $total_amount }}</td>
            <td style="text-align: right;">{{ $total_quantity }}</td>
        </tr>
    </x-slot>
</x-report>
