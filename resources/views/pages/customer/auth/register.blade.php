<x-customer>
    @push('pageTitle', 'Registrarse')

    <div class="md:flex md:justify-center">
        <div class="px-4 md:px-0">
            <!--TITLE-->
            <x-title class="mb-10 pt-10">Crear cuenta</x-title>
            <!--FORM-->
            <div class="bg-white rounded p-5 my-10 w-full md:w-[450px] ">
                <!--VALIDATIONS-->
                <x-inputs.validation-errors class="mb-4" />
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('customer.register.post') }}">
                    @csrf

                    <div>
                        <x-customer-label for="name" value="{{ __('Name') }}" is_required />
                        <x-input id="name" class="block mt-1 w-96" type="text" name="name" :value="old('name')"
                            required autofocus autocomplete="name" />
                    </div>

                    <div class="mt-4">
                        <x-customer-label for="surname" value="{{ __('Apellido') }}" is_required />
                        <x-input id="surname" class="block mt-1 w-96" type="text" name="surname" :value="old('surname')"
                            required autofocus autocomplete="surname" />
                    </div>

                    <div class="mt-4">
                        <x-customer-label for="email" value="{{ __('Email') }}" is_required />
                        <x-input id="email" class="block mt-1 w-96" type="email" name="email" :value="old('email')"
                            required autocomplete="username" />
                    </div>

                    <div class="mt-4">
                        <x-customer-label for="phone" value="{{ __('Telefono') }}" is_required />
                        <x-input id="phone" class="block mt-1 w-96" type="text" name="phone" :value="old('phone')"
                            required autocomplete="phone" />
                    </div>

                    <div class="mt-4">
                        <x-customer-label for="password" value="{{ __('Password') }}" is_required />
                        <x-input id="password" class="block mt-1 w-96" type="password" name="password" required
                            autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <x-customer-label for="password_confirmation" value="{{ __('Confirm Password') }}"
                            is_required />
                        <x-input id="password_confirmation" class="block mt-1 w-96" type="password"
                            name="password_confirmation" required autocomplete="new-password" />
                    </div>
                    <!--ACTIONS-->
                    <div class="flex flex-col items-center pt-5 gap-5">

                        <x-customer-button class="w-full">
                            Registrarse
                        </x-customer-button>

                        <span>¿Ya tienes cuenta? <a
                                class="underline text-font-primary hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brown-primary"
                                href="{{ route('customer.login') }}">Inicia sesión
                            </a></span>
                    </div>

                </form>
            </div>
        </div>
    </div>

</x-customer>
