<div class="flex flex-col gap-3">
    <x-inputs.disabled title="Telefono">
        <x-slot name="icon">
            <i class="icon-phone-ios text-3xl"></i>
        </x-slot>
        {{ $company_contact->phone ?? 'No hay telefono registrado' }}
    </x-inputs.disabled>

    <x-inputs.disabled title="Correo electrónico">
        <x-slot name="icon">
            <i class="icon-email text-3xl"></i>
        </x-slot>
        {{ $company_contact->email ?? 'No hay correo electrónico registrado' }}
    </x-inputs.disabled>

    <x-inputs.disabled title="Dirección">

        <x-slot name="icon">
            <i class="icon-pin text-3xl"></i>
        </x-slot>
        {{ $address ?? '' }}
    </x-inputs.disabled>

    <h3 class="text-gray-800">Redes Sociales</h3>

    <hr>

    <x-inputs.disabled title="Facebook">
        <x-slot name="icon">
            <i class="icon-facebook text-3xl"></i>
        </x-slot>
        <a href="{{ $company_contact->facebook ?? '' }}" target="_blank">
            {{ $company_contact->facebook ?? 'No hay Facebook registrado' }}
        </a>
    </x-inputs.disabled>

    <x-inputs.disabled title="Instagram">
        <x-slot name="icon">
            <i class="icon-instagram text-3xl"></i>
        </x-slot>
        <a href="{{ $company_contact->instagram ?? '' }}" target="_blank">
            {{ $company_contact->instagram ?? 'No hay Instagram registrado' }}
        </a>
    </x-inputs.disabled>

    <x-inputs.disabled title="TikTok">

        <x-slot name="icon">
            <i class="icon-tiktok text-3xl"></i>
        </x-slot>
        <a href="{{ $company_contact->tiktok ?? '' }}" target="_blank">
            {{ $company_contact->tiktok ?? 'No hay TikTok registrado' }}
        </a>
    </x-inputs.disabled>


</div>
