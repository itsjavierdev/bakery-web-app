<x-mail::message>


# ¡Hola {{ $customer->name }}!,

Tu pedido se ha realizado correctamente. A continuación, te compartimos los detalles:

## Resumen del Pedido

<x-mail::table>
| Producto | Precio Bolsa | Cantidad | Subtotal |
|:----------|-------------:|---------:|---------:|
@foreach ($details as $item)
| {{ $item->product_name }} | ${{ number_format($item->price_by_bag, 2) }} | {{ $item->quantity }} | ${{ number_format($item->subtotal, 2) }} |
@endforeach
| **Total** |  |  | **${{ number_format($order->total, 2) }}** |
</x-mail::table>

**Fecha de entrega:** {{ \Carbon\Carbon::parse($delivery_time->time)->format('H:i') }} del {{ \Carbon\Carbon::parse($order->delivery_date)->translatedFormat('d F Y') }}

@if (!empty($order->notes))
**Nota del Pedido:** {{ $order->notes }}
@endif

@if (!empty($address->address))
**Dirección de Envío:** {{ $address->address}}, {{ $address->reference}}
@else
**Puede retirar su pedido en:** {{ $addressBakery->address }}
@endif

---

Gracias por tu compra. Si tienes alguna consulta, no dudes en contactarnos.

Saludos,<br>
{{ config('app.name') }}
</x-mail::message>