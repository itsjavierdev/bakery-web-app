<x-action-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        Revisa la información de tu cuenta y la dirección de correo electrónico para asegurarte de que sean correctas.
    </x-slot>

    <x-slot name="content">
        <div class="col-span-6 sm:col-span-6">
            <x-detail-row class="!grid-cols-2" classContent="!col-span-1" title="ID">{{ $staff->id }}</x-detail-row>
            <x-detail-row class="!grid-cols-2" classContent="!col-span-1"
                title="Nombre">{{ $staff->name }}</x-detail-row>
            <x-detail-row class="!grid-cols-2" classContent="!col-span-1"
                title="Apellido">{{ $staff->surname }}</x-detail-row>
            <x-detail-row class="!grid-cols-2" classContent="!col-span-1"
                title="Telefono">{{ $staff->phone }}</x-detail-row>
            <x-detail-row class="!grid-cols-2" classContent="!col-span-1"
                title="Carnet de identidad">{{ $staff->CI }}</x-detail-row>
            <x-detail-row class="!grid-cols-2" classContent="!col-span-1"
                title="Fecha de nacimiento"><x-date-format>{{ $staff->birthdate }}
                </x-date-format></x-detail-row>
            <x-detail-row class="!grid-cols-2" classContent="!col-span-1"
                title="Correo electronico">{{ $user->email }}</x-detail-row>
            <x-detail-row class="!grid-cols-2" classContent="!col-span-1"
                title="Rol">{{ $role->name }}</x-detail-row>
        </div>
    </x-slot>

</x-action-section>
