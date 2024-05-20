@if (isset($company_contact))
    <footer class="flex w-full md:w-auto md:justify-center bg-brown-primary text-yellow-primary p-10">
        <div class="flex flex-col md:flex-row items-start gap-5">
            @if ($company_contact->facebook || $company_contact->instagram || $company_contact->instagram)
                <div class="max-w-full md:max-w-xs mr-36 flex flex-col gap-5 mb-10">
                    <h1 class="text-2xl mb-2">Síganos</h1>
                    @if ($company_contact->facebook)
                        <a class="flex items-start gap-6" href="{{ $company_contact->facebook }}">
                            <i class="icon-facebook text-2xl"></i>
                            <span>Facebook</span>
                        </a>
                    @endif
                    @if ($company_contact->instagram)
                        <a class="flex items-start gap-6" href="{{ $company_contact->instagram }}">
                            <i class="icon-instagram text-2xl"></i>
                            <span>Instagram</span>
                        </a>
                    @endif
                    @if ($company_contact->instagram)
                        <a class="flex items-start gap-6" href="{{ $company_contact->instagram }}">
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
