<x-guest>

    @push('pagetitle', 'Iniciar sesión')

    <x-authentication-card>
        <x-inputs.validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-inputs.label for="email" value="{{ __('Email') }}" />
                <x-inputs.text id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-inputs.label for="password" value="{{ __('Password') }}" />
                <x-inputs.text id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-inputs.checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex flex-col gap-3 items-center justify-end mt-4">

                <x-button class="w-full h-14 justify-center" text_size="text-base">
                    {{ __('Log in') }}
                </x-button>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

            </div>
        </form>
    </x-authentication-card>
</x-guest>
