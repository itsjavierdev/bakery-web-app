@props(['bg_color' => 'bg-yellow-secondary', 'register' => true])

<div>
    @if ($register)
        @if (!Auth::guard('customer')->check())
            <div class="w-full {{ $bg_color }}">
                <div class=" max-w-2xl mx-auto flex  flex-col justify-center py-20 items-center gap-20">
                    <div class="flex flex-col gap-10 items-center">
                        <h3 class="text-4xl text-brown-primary text-center font-medium tracking-wide"
                            style="font-family: 'Kreon', serif;">Regístrese
                            para Realizar Pedidos</h3>
                        <p class="text-center text-lg font-base text-gray-600">Para poder realizar
                            pedidos de
                            nuestros
                            productos, es
                            necesario
                            registrarse y
                            verificar su cuenta. Una
                            vez verificado, podrá realizar sus pedidos en línea.</p>
                    </div>
                    <a href="{{ route('customer.register') }}">
                        <x-customer-button>
                            Regístrese Ahora
                        </x-customer-button>
                    </a>
                </div>
            </div>
        @endif
    @endif

    @if (isset($company_contact))
        <footer class="flex w-full md:w-auto md:justify-center bg-brown-primary text-yellow-secondary p-10">
            <div class="flex flex-col md:flex-row items-start gap-5">
                @if ($company_contact->facebook || $company_contact->instagram || $company_contact->instagram)
                    <div class="max-w-full md:max-w-xs mr-36 flex flex-col gap-5 mb-10">
                        <h1 class="text-2xl mb-2">Síganos</h1>
                        @if ($company_contact->facebook)
                            <a class="flex items-start gap-6" href="{{ $company_contact->facebook }}" target="_blank">
                                <i class="icon-facebook text-2xl"></i>
                                <span>Facebook</span>
                            </a>
                        @endif
                        @if ($company_contact->instagram)
                            <a class="flex items-start gap-6" href="{{ $company_contact->instagram }}" target="_blank">
                                <i class="icon-instagram text-2xl"></i>
                                <span>Instagram</span>
                            </a>
                        @endif
                        @if ($company_contact->instagram)
                            <a class="flex items-start gap-6" href="{{ $company_contact->tiktok }}" target="_blank">
                                <i class="icon-tiktok text-2xl"></i>
                                <span>Tiktok</span>
                            </a>
                        @endif
                    </div>
                @endif
                @if ($address || $company_contact->phone || $company_contact->email)
                    <div class="max-w-full md:max-w-xs flex flex-col gap-5">
                        <h1 class="text-2xl mb-2">Contáctenos</h1>
                        @if ($address)
                            <a class="flex items-start gap-6">
                                <i class="icon-pin-mark text-2xl"></i>
                                <span>{{ $address }}</span>
                            </a>
                        @endif
                        @if ($company_contact->phone)
                            <a class="flex items-start gap-6">
                                <i class="icon-phone-android text-2xl"></i>
                                <span>+591 {{ $company_contact->phone }}</span>
                            </a>
                        @endif
                        @if ($company_contact->email)
                            <a class="flex items-start gap-6">
                                <i class="icon-email text-2xl"></i>
                                <span>{{ $company_contact->email }}</span>
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </footer>
    @endif
</div>
