<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Staff;
use Livewire\Livewire;
use App\Livewire\Staff as StaffLivewire;
use Spatie\Permission\Models\Role;

class UserManageTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $another_user;
    protected $role;

    protected function setUp(): void
    {
        parent::setUp();
        $this->role = Role::create(['name' => 'Administrador']);
        //Create example data
        $this->user = User::factory()->create()->assignRole($this->role);
        $this->another_user = User::factory()->create()->assignRole($this->role);
    }

    public function test_a_user_can_be_created_in_create_staff(): void
    {
        // Create the user in live wire component
        Livewire::test(StaffLivewire\Create::class)
            ->set('staff_create.name', 'Cristhian')
            ->set('staff_create.surname', 'Justiniano')
            ->set('staff_create.phone', '75525722')
            ->set('staff_create.CI_number', '13315000')
            ->set('staff_create.CI_extension', 'SC')
            ->set('staff_create.birthdate', '1990-01-01')
            ->set('add_account', 'true')
            ->set('user_create.role', $this->role->id)
            ->set('user_create.email', 'test@gmail.com')
            ->set('user_create.password', 'Test.123')
            ->set('user_create.password_confirmation', 'Test.123')
            ->call('save')
            ->assertRedirect('personal')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Personal creado correctamente');

        // Verify that the user was created in the database
        $this->assertTrue(User::where('email', 'test@gmail.com')->exists());
    }
    public function test_can_display_list_of_user(): void
    {
        // Display the list of user
        $response = $this->actingAs($this->user)->get('/personal');

        // Verify that the user are displayed
        $response->assertStatus(200);
        $response->assertSee($this->another_user->email);
        $response->assertSee($this->role->name);
    }
}
