<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comprobante de venta</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 8px;
            width: 100%;
        }

        .header,
        .footer {
            text-align: center;
            border-bottom: 1px dotted #000;
            border-top: 1px dotted #000;
        }

        .content {
            margin-bottom: 10px;
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
        }

        tbody {
            border-bottom: 1px dotted #000;
        }

        .content th,
        .content td {
            padding: 5px;
            text-align: left;
        }

        .total-title {
            font-weight: bold;
            text-align: right;
            /* Alineación a la derecha */
        }

        .voucher-title {
            text-align: center;
            border-bottom: 1px dotted #000;
            padding-bottom: 10px;
        }

        /* Estilos para las filas del encabezado de la tabla */
        .content table thead tr {
            border-top: 1px dotted #000;
            border-bottom: 1px dotted #000;
        }

        @page {
            margin: 0.1cm;
        }
    </style>
</head>

<body>
    <div class="header">
        <h4>PANADERÍA SAN XAVIER</h4>
        <p>Dirección: {{ $company_address->address }}</p>
        <p>Tel: +591 {{ $company_contact->phone }}</p>
    </div>
    <div>
        <h4 class="voucher-title">COMPROBANTE DE VENTA</h4>
    </div>
    <div class="content">
        <p>Venta N°: {{ $sale->id }}</p>
        <p>Fecha: {{ $sale->created_at }}</p>
        <p>Cliente: {{ $sale->customer->name . ' ' . $sale->customer->surname }}</p>
        <p>Teléfono: +591 {{ $sale->customer->phone }}</p>
        <p>Personal de Entrega: {{ $sale->staff->name . ' ' . $sale->staff->surname }}</p>

        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sale_details as $detail)
                    <tr>
                        <td>{{ $products->where('id', $detail->product_id)->first()->name }}</td>
                        <td>Bs{{ $detail->product_price }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>Bs{{ $detail->subtotal }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="total-title" colspan="3" style="text-align: right; padding: 0;">
                        Total:
                    </td>
                    <td class="total-quantity">Bs{{ $sale->total }}</td>
                </tr>
                <tr>
                    <td class="total-title" colspan="3" style="text-align: right; padding: 0;">
                        Total pagado:
                    </td>
                    <td class="total-quantity">Bs{{ $sale->paid_amount }}</td>
                </tr>
                <tr>
                    <td class="total-title" colspan="3" style="text-align: right; padding: 0;">
                        Total pendiente:
                    </td>
                    <td class="total-quantity">Bs{{ $sale->total - $sale->paid_amount }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="footer">
        <p>Gracias por su compra</p>
    </div>
</body>

</html>
