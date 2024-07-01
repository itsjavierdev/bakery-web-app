<x-customer :register="false">
    @push('pageTitle', 'Iniciar sesión')

    <div class="md:flex md:justify-center">
        <div class="px-4 md:px-0">
            <!--TITLE-->
            <x-title class="mb-10 pt-10">Iniciar sesión</x-title>
            <div class="w-full flex justify-center pb-5">
                <span>¿No tienes cuenta? <a
                    class="underline text-font-primary hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brown-primary"
                    href="{{ route('customer.register') }}">Crear una cuenta
                </a></span>
            </div>
            <!--FORM-->
            <div class="bg-white rounded p-5 mb-10 w-full md:w-[450px]">

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

                       
                           
                    </div>
                    <div>
                        <div class="w-full flex items-center justify-center my-4 py-6">
                            <div class="flex items-center w-full">
                                <hr class="flex-grow border-gray-300">
                                <p class="px-4 text-sm">o también puedes</p>
                                <hr class="flex-grow border-gray-300">
                            </div>
                        </div>
                        <a href="/google-auth/redirect" class="px-4 py-2 border flex gap-2 border-slate-200 bg-white dark:border-slate-700 rounded-lg text-slate-700 dark:text-slate-200 hover:border-slate-400 dark:hover:border-slate-500 hover:text-slate-900 dark:hover:text-slate-300 hover:shadow transition duration-150 justify-center">
                            <img class="w-6 h-6" src="https://www.svgrepo.com/show/475656/google-color.svg" loading="lazy" alt="google logo">
                            <span>Continuar con Google</span>
                        </a>
                      
                    </div>
                </form>
            </div>
                            
        </div>
    </div>

</x-customer>
