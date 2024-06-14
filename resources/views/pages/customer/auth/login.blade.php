<x-customer :register="false">
    @push('pageTitle', 'Iniciar sesión')

    <div class="md:flex md:justify-center">
        <div class="px-4 md:px-0">
            <!--TITLE-->
            <x-title class="mb-10 pt-10">Iniciar sesión</x-title>
            <!--FORM-->
            <div class="bg-white rounded p-5 my-10 w-full md:w-[450px]">
                <!--VALIDATIONS-->
                <x-inputs.validation-errors class="mb-4" />
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('customer.login.post') }}">
                    @csrf

                    <div>
                        <x-customer-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-96" type="email" name="email" :value="old('email')"
                            required autofocus autocomplete="username" />
                    </div>
                    <div class="mt-4">
                        <x-customer-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-1 w-96" type="password" name="password" required
                            autocomplete="current-password" />
                    </div>
                    <!--ACTIONS-->
                    <div class="flex flex-col items-center pt-5 gap-5">

                        <x-customer-button class="w-full">
                            {{ __('Log in') }}
                        </x-customer-button>

                        <span>¿Aún no te has registrado? <a
                                class="underline text-font-primary hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brown-primary"
                                href="{{ route('customer.register') }}">Crear una cuenta
                            </a></span>
                    </div>

                </form>
            </div>
        </div>
    </div>

</x-customer>
