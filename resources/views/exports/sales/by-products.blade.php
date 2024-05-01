<x-report date_start="{{ $date_start }}" date_end="{{ $date_end }}" colspan="5">
    @push('title', 'Ventas por productos')

    <x-slot name="head">
        <th>Producto</th>
        <th style="text-align: right;">Precio</th>
        <th style="text-align: right;">Cantidad</th>
        <th style="text-align: right;">Monto total</th>
        <th style="text-align: right;">Porcentaje</th>
    </x-slot>
    @foreach ($data as $item)
        @php
            $price = 'Bs ' . number_format($item->price, 1, ',', '.');
            $total_amount = 'Bs ' . number_format($item->total_amount, 1, ',', '.');
            $percentage = number_format($item->percentage, 1) . '%';
        @endphp
        <tr>
            <td>{{ $item->name }}</td>
            <td style="text-align: right;">{{ $price }}</td>
            <td style="text-align: right;">{{ $item->quantity }}</td>
            <td style="text-align: right;">{{ $total_amount }}</td>
            <td style="text-align: right;">{{ $percentage }}</td>
        </tr>
    @endforeach
    <x-slot name="footer">
        @php
            $total_quantity = $data->sum('quantity');
            $total_amount = 'Bs ' . number_format($data->sum('total_amount'), 1, ',', '.');
            $total_percentage = number_format($data->sum('percentage'), 1) . '%';
        @endphp
        <tr>
            <td colspan="2"></td>
            <td style="text-align: right;">{{ $total_quantity }}</td>
            <td style="text-align: right;">{{ $total_amount }}</td>
            <td style="text-align: right;">{{ $total_percentage }}</td>
        </tr>
    </x-slot>
</x-report>
