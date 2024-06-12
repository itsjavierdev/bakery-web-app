<x-report date_start="{{ $date_start }}" date_end="{{ $date_end }}" colspan="4">
    @push('title', "Ventas de {$staff->name} {$staff->surname}")

    <x-slot name="head">
        <th>ID</th>
        <th>Fecha</th>
        <th>Cliente</th>
        <th style="text-align: right;">Monto</th>
    </x-slot>
    @foreach ($data as $item)
        @php
            $date = date('d/m/Y', strtotime($item->created_at));
            $customer = $item->customer->name . ' ' . $item->customer->surname;
            $total = 'Bs ' . number_format($item->total, 1, ',', '.');
        @endphp
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $date }}</td>
            <td>{{ $customer }}</td>
            <td style="text-align: right;">{{ $total }}</td>
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
        </tr>
    </x-slot>
</x-report>
