<x-admin-header title="Mi perfil" titleAlign="center">
    <div class="p-6">
        <div class="max-w-7xl mx-auto py-2 md:py-5 lg:px-8">
            @can('profile.update')
                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                    @livewire('livewire.admin.management-admin.profile.update-profile-information-form')

                    <x-section-border />
                @endif
            @else
                <livewire:admin.management-admin.profile.profile-information />
                <x-section-border />
            @endcan


            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('livewire.admin.management-admin.profile.update-password-form')
                </div>

                <x-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('livewire.admin.management-admin.profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('livewire.admin.management-admin.profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-admin-header>
