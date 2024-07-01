<x-mail::message>
# Nuevo Cliente Registrado

Se ha registrado un nuevo cliente en el sistema. Aquí están los detalles:

**Nombre:** {{ $customer->name }}  
**Apellido:** {{ $customer->surname }}  
**Teléfono:** {{ $customer->phone }}  
**Email:** {{ $customer->email }}

<x-mail::button :url="route('customers.show', $customer->id)">
Ver Detalle
</x-mail::button>

</x-mail::message>