<x-report date_start="{{ $date_start }}" date_end="{{ $date_end }}" colspan="4">
    @push('title', 'Ventas por personal')

    <x-slot name="head">
        <th>Personal</th>
        <th style="text-align: right;">Ventas</th>
        <th style="text-align: right;">Monto total</th>
        <th style="text-align: right;">Porcentaje</th>
    </x-slot>
    @foreach ($data as $item)
        @php
            $total_amount = 'Bs ' . number_format($item->total_amount, 1, ',', '.');
            $percentage = number_format($item->percentage, 1) . '%';
        @endphp
        <tr>
            <td>{{ $item->name }}</td>
            <td style="text-align: right;">{{ $item->total_sales }}</td>
            <td style="text-align: right;">{{ $total_amount }}</td>
            <td style="text-align: right;">{{ $percentage }}</td>
        </tr>
    @endforeach
    <x-slot name="footer">
        @php
            $total_sales = $data->sum('total_sales');
            $total_amount = 'Bs ' . number_format($data->sum('total_amount'), 1, ',', '.');
            $total_percentage = number_format($data->sum('percentage'), 1) . '%';
        @endphp
        <tr>
            <td></td>
            <td style="text-align: right;">{{ $total_sales }}</td>
            <td style="text-align: right;">{{ $total_amount }}</td>
            <td style="text-align: right;">{{ $total_percentage }}</td>
        </tr>
    </x-slot>
</x-report>
