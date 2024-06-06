<x-report date_start="{{ $date_start }}" date_end="{{ $date_end }}" colspan="4">
    @push('title', 'Horarios mas solicitados')

    <x-slot name="head">
        <th>Productos</th>
        <th style="text-align: right;">Cantidad suelta</th>
        <th style="text-align: right;">Cantidad por bolsa</th>
        <th style="text-align: right;">Monto total</th>
    </x-slot>
    @foreach ($data as $item)
        <tr>
            <td>{{ $item->time }}</td>
            <td style="text-align: right;">{{ $item->total_orders }}</td>
            <td style="text-align: right;">{{ $item->address_orders }}</td>
            <td style="text-align: right;">{{ $item->no_address_orders }}</td>
        </tr>
    @endforeach
    <x-slot name="footer">
        @php
            $total_orders = $data->sum('total_orders');
            $total_address_orders = $data->sum('address_orders');
            $total_no_address_orders = $data->sum('no_address_orders');
        @endphp
        <tr>
            <td colspan="1"></td>
            <td style="text-align: right;">{{ $total_orders }}</td>
            <td style="text-align: right;">{{ $total_address_orders }}</td>
            <td style="text-align: right;">{{ $total_no_address_orders }}</td>
        </tr>
    </x-slot>
</x-report>
