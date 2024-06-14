<x-customer>
    @push('pageTitle', 'Gracias por su compra')

    <section class="flex justify-center items-center py-10 ">
        <div class="py-52 max-w-xs flex flex-col items-center justify-center text-center gap-5">
            <span class="text-4xl">¡Gracias por tu pedido!</span>
            <p>Estamos procesando tu pedido y te notificaremos una vez que esté en camino.</p>
            <a href="/" class="w-full">
                <x-customer-button variant="secondary" size="large" class="w-full">VOLVER
                    AL
                    INICIO</x-customer-button>
            </a>
        </div>
    </section>
</x-customer>
