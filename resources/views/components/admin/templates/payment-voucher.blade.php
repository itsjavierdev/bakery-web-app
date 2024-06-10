<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comprobante de pago</title>
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

        .payment-title {
            text-align: center;
            border-top: 1px dotted #000;
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
        <h4 class="voucher-title">COMPROBANTE DE PAGO</h4>
    </div>
    <div class="info-header">
        <p>Fecha: {{ $payment->created_at }}</p>
        <p>Cliente: {{ $payment->customer->name . ' ' . $payment->customer->surname }}</p>
        <p>Teléfono: +591 {{ $payment->customer->phone }}</p>
    </div>
    <div class="content">
        <table>
            <thead>
                <tr>
                    <th colspan="2">Detalles del pago</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Monto pagado:</td>
                    <td>Bs{{ number_format($payment->amount, 1) }}</td>

                </tr>
                <tr>
                    <td>Venta asociada: </td>
                    <td>Venta #{{ $sale->id }}</td>
                </tr>
                <tr>
                    <td>Total de la venta</td>
                    <td>Bs{{ number_format($sale->total, 1) }}</td>
                </tr>
                <tr>
                    <td>Saldo anterior</td>
                    <td>Bs{{ number_format($previous_balance, 1) }}</td>
                </tr>

                <tr>
                    <td>Saldo actual</td>
                    <td>Bs{{ number_format($sale->total - $sale->paid_amount, 1) }}</td>
                </tr>
            </tbody>

        </table>
    </div>
    <div style="border-top: 1px dotted #000">
        <p>Recibido por: {{ $payment->staff->name . ' ' . $payment->staff->surname }}</p>
    </div>
    <div class="footer">
        <p>Gracias por su pago</p>
    </div>
</body>

</html>
