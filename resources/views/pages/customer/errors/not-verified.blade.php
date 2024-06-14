<x-customer class="min-h-[83vh]">
    @push('pageTitle', 'No estas verificado')

    <section class="flex min-h-[75vh] justify-center items-center py-10">

        <div class="max-w-md flex flex-col items-center justify-center text-center gap-10">
            <span class="text-3xl">Aun no estas verificado</span>
            <p>Un miembro de nuestro equipo se pondrá en contacto contigo para confirmar algunos detalles.</p>
            <a href="/" class="max-w-xs">
                <x-customer-button variant="secondary" size="large" class="w-full mt-10">VOLVER
                    AL
                    INICIO</x-customer-button>
            </a>
        </div>
    </section>
</x-customer>
