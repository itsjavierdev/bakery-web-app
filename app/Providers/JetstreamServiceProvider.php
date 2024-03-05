<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;
use App\Livewire\Profile\DeleteUserForm;
use App\Livewire\Profile\LogoutOtherBrowserSessionsForm;
use App\Livewire\NavigationMenu;
use App\Livewire\Profile\UpdatePasswordForm;
use App\Livewire\Profile\UpdateInformationForm;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            if (config('jetstream.stack') === 'livewire' && class_exists(Livewire::class)) {
                Livewire::component('livewire.navigation-menu', NavigationMenu::class);
                Livewire::component('livewire.profile.update-profile-information-form', UpdateInformationForm::class);
                Livewire::component('livewire.profile.update-password-form', UpdatePasswordForm::class);
                Livewire::component('livewire.profile.logout-other-browser-sessions-form', LogoutOtherBrowserSessionsForm::class);
                Livewire::component('livewire.profile.delete-user-form', DeleteUserForm::class);
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
