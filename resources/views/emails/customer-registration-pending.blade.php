<x-mail::message>
# ¡Registro recibido!

Hola {{ $customer->name }},

Gracias por registrarte en **{{ config('app.name') }}**.  

Revisaremos tu información y nos pondremos en contacto contigo en las próximas 24 horas para activar tu cuenta.  

Si tienes alguna pregunta, no dudes en responder a este correo.

Saludos,  
**El equipo de {{ config('app.name') }}**
</x-mail::message>
