<x-report date_start="{{ $date_start }}" date_end="{{ $date_end }}" colspan="5">
    @push('title', 'Ventas')

    <x-slot name="head">
        <th>Fecha</th>
        <th>Personal</th>
        <th>Cliente</th>
        <th style="text-align: right;">Monto</th>
        <th style="text-align: right;">Cantidad productos</th>
    </x-slot>
    @foreach ($data as $item)
        @php
            $date = date('d/m/Y', strtotime($item->created_at));
            $staff = $item->staff->name . ' ' . $item->staff->surname;
            $customer = $item->customer->name . ' ' . $item->customer->surname;
            $total = 'Bs ' . number_format($item->total, 1, ',', '.');
            $quantity = $item->total_quantity;
        @endphp
        <tr>
            <td>{{ $date }}</td>
            <td>{{ $staff }}</td>
            <td>{{ $customer }}</td>
            <td style="text-align: right;">{{ $total }}</td>
            <td style="text-align: right;">{{ $quantity }}</td>
        </tr>
    @endforeach
    <x-slot name="footer">
        @php
            $total_sales = 'Bs ' . number_format($data->sum('total'), 1, ',', '.');
            $total_quantity = $data->sum('total_quantity');
        @endphp
        <tr>
            <td colspan="3"></td>
            <td style="text-align: right;">{{ $total_sales }}</td>
            <td style="text-align: right;">{{ $total_quantity }}</td>
        </tr>
    </x-slot>
</x-report>
