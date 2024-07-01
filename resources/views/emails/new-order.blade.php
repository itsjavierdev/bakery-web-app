<x-mail::message>
# Nuevo Pedido Recibido

Se ha registrado un nuevo pedido en el sistema.

## Detalles del Pedido:
- **Cliente:** {{ $customer->name }} {{ $customer->surname }}
- **Fecha de entrega:** {{ \Carbon\Carbon::parse($delivery_time->time)->format('H:i') }} del {{ \Carbon\Carbon::parse($order->delivery_date)->translatedFormat('d F Y') }}
- **Entrega a Domicilio:** {{ $order->address_id ? 'Sí' : 'No' }}

<x-mail::button :url="route('orders.show', $order->id)">
Ver Pedido
</x-mail::button>
</x-mail::message>