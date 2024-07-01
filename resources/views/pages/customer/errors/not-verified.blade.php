<x-customer class="min-h-[83vh]">
    @push('pageTitle', 'No estas verificado')

    <section class="flex min-h-[75vh] justify-center items-center py-10">

        <div class="max-w-md flex flex-col items-center justify-center text-center gap-10">
            <span class="text-3xl">Tu cuenta aún está en revisión</span>
            <p>Nuestro equipo está verificando la información de tu negocio. Nos pondremos en contacto contigo pronto para completar el proceso.</p>
            <a href="/" class="max-w-xs">
                <x-customer-button variant="secondary" size="large" class="w-full mt-10">VOLVER
                    AL
                    INICIO</x-customer-button>
            </a>
        </div>
    </section>
</x-customer>
