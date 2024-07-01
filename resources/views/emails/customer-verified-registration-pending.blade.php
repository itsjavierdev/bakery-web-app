<x-mail::message>
# ¡Registro confirmado y correo verificado!  

Hola {{ $customer->name }},  

Tu correo electrónico ha sido verificado con éxito. 🎉  

Gracias por registrarte en **{{ config('app.name') }}**. Ahora revisaremos tu información y nos pondremos en contacto contigo en las próximas 24 horas para activar tu cuenta.  

Si tienes alguna pregunta, no dudes en responder a este correo.  

Saludos,  
**El equipo de {{ config('app.name') }}**
</x-mail::message>