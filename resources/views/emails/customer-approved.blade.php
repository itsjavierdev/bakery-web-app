<x-mail::message>
# ¡Hola {{ $customer->name }}!

Nos complace informarte que tu cuenta ha sido aprobada por nuestro equipo, y ahora puedes comenzar a realizar pedidos en {{ config('app.name') }}.
    
Si tienes alguna duda o necesitas más información, no dudes en contactarnos.
    
Saludos,
**El equipo de {{ config('app.name') }}
</x-mail::message>
