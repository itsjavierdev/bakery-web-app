<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Livewire\Admin\Profile\UpdateInformationForm;
use App\Livewire\Admin\Profile\ProfileInformation;
use Livewire\Livewire;
use Tests\TestCase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ProfileInformationTest extends TestCase
{
    use RefreshDatabase;

    public $role_admin;
    public $role_deliver;
    public $permission_profile;
    public $user_admin;
    public $user_deliver;

    protected function setUp(): void
    {
        parent::setUp();
        $this->role_admin = Role::create(['name' => 'Administrador']);
        $this->role_deliver = Role::create(['name' => 'Repartidor']);

        Permission::create(['name' => 'profile.update', 'description' => 'Editar', 'module' => 'Perfil', 'action' => 'update'])->assignRole($this->role_admin);


        $this->user_admin = User::factory()->create()->assignRole($this->role_admin);

        $this->user_deliver = User::factory()->create()->assignRole($this->role_admin);
    }

    public function test_current_profile_information_is_available(): void
    {
        $this->actingAs($this->user_deliver);

        $component = Livewire::test(ProfileInformation::class);

        $this->assertEquals($this->user_deliver->email, $component->user->email);
    }
    public function test_current_profile_information_is_available_in_edit(): void
    {
        $this->actingAs($this->user_admin);

        $component = Livewire::test(UpdateInformationForm::class);

        $this->assertEquals($this->user_admin->email, $component->state['email']);
    }

    public function test_profile_information_can_be_updated(): void
    {
        $this->actingAs($this->user_admin);

        Livewire::test(UpdateInformationForm::class)
            ->set('state.id', $this->user_admin->id)
            ->set('state.name', 'Javier')
            ->set('state.surname', 'Vargas')
            ->set('state.phone', '75528902')
            ->set('state.CI_number', '13335700')
            ->set('state.CI_extension', 'SC')
            ->set('state.CI', '13335700 SC')
            ->set('state.birthdate', '2002-02-02')
            ->set('state.email', 'test@example.com')
            ->call('updateProfileInformation');

        $this->assertEquals('test@example.com', $this->user_admin->fresh()->email);
        $this->assertEquals('Javier', $this->user_admin->staff->fresh()->name);
        $this->assertEquals('Vargas', $this->user_admin->staff->fresh()->surname);
        $this->assertEquals('75528902', $this->user_admin->staff->fresh()->phone);
        $this->assertEquals('13335700 SC', $this->user_admin->staff->fresh()->CI);
        $this->assertEquals('2002-02-02', $this->user_admin->staff->fresh()->birthdate);
    }
}
