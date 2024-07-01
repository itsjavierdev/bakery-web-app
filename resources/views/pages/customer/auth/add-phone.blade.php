<x-customer>
    @push('pageTitle', 'Carrito de compras') <div class="md:flex md:justify-center">
        <div class="px-4 md:px-0">
            <!--TITLE-->
            <x-title class="mb-10 pt-10">Completar información</x-title>
            <!--FORM--> <div class="bg-white rounded p-5 mb-10 w-full md:w-[450px]">
                 <!--VALIDATIONS-->
                 <x-inputs.validation-errors class="mb-4" />
                 @if (session('status'))
                     <div class="mb-4 font-medium text-sm text-green-600">
                         {{ session('status') }}
                     </div>
                 @endif
                <form method="POST" action="{{ route('customer.register.finish') }}">
                    @csrf
                
                    <div>
                        <x-customer-label for="name" value="{{ __('Nombre') }}" is_required />
                        <x-input id="name" class="block mt-1 w-96" type="text" name="name"
                            value="{{ old('name', $firstName) }}" required autofocus autocomplete="name" />
                    </div>
                
                    <div class="mt-4">
                        <x-customer-label for="surname" value="{{ __('Apellido') }}" is_required />
                        <x-input id="surname" class="block mt-1 w-96" type="text" name="surname"
                            value="{{ old('surname', $customer->surname ?? '') }}" required autocomplete="surname" />
                    </div>
                
                    <div class="mt-4">
                        <x-customer-label for="phone" value="{{ __('Teléfono') }}" is_required />
                        <x-input id="phone" class="block mt-1 w-96" type="text" name="phone"
                            value="{{ old('phone') }}" required autocomplete="phone" />
                    </div>
                
                    <div class="flex flex-col items-center pt-5 gap-5">
                        <x-customer-button class="w-full">
                            Enviar
                        </x-customer-button>
                    </div>
                </form>
               
            </div>
        </div>
    </div>
</x-customer>