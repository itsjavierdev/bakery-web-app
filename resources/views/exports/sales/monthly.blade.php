<x-report date_start="{{ $date_start }}" date_end="{{ $date_end }}" colspan="5">
    @push('title', 'Ventas Mensuales')

    <x-slot name="head">
        <th>Mes</th>
        <th style="text-align: right;">Clientes</th>
        <th style="text-align: right;">Ventas Totales</th>
        <th style="text-align: right;">Monto Total</th>
        <th style="text-align: right;">Transacción Promedio</th>
    </x-slot>
    @foreach ($data as $item)
        @php
            $date = $item->month . '/' . $item->year;
            $quantity = $item->total_sales;
            $total = 'Bs ' . number_format($item->total_amount, 1, ',', '.');
            $avarage_amount = 'Bs ' . number_format($item->average_transaction, 1, ',', '.');
            $customers = $item->unique_customers;
        @endphp
        <tr>
            <td>{{ $date }}</td>
            <td style="text-align: right;">{{ $customers }}</td>
            <td style="text-align: right;">{{ $quantity }}</td>
            <td style="text-align: right;">{{ $total }}</td>
            <td style="text-align: right;">{{ $avarage_amount }}</td>
        </tr>
    @endforeach
    <x-slot name="footer">
        @php
            $total_amount = 'Bs ' . number_format($data->sum('total_amount'), 1, ',', '.');
            $total_sales = $data->sum('total_sales');
        @endphp
        <tr>
            <td colspan="2"></td>
            <td style="text-align: right;">{{ $total_sales }}</td>
            <td style="text-align: right;">{{ $total_amount }}</td>
            <td colspan="1"></td>
        </tr>
    </x-slot>
</x-report>
