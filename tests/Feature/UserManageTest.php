<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Staff;
use Livewire\Livewire;
use App\Livewire\Admin\ManagementAdmin\Staff as StaffLivewire;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserManageTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $another_user;
    protected $role;
    protected $staff;
    protected $userWithStaff;
    protected $staffWithUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->role = Role::create(['name' => 'Administrador']);

        Permission::create(['name' => 'staff.create', 'description' => 'Crear', 'module' => 'Personal', 'action' => 'create'])->syncRoles([$this->role]);
        Permission::create(['name' => 'staff.read', 'description' => 'Ver', 'module' => 'Personal', 'action' => 'read'])->syncRoles([$this->role]);
        Permission::create(['name' => 'staff.update', 'description' => 'Editar', 'module' => 'Personal', 'action' => 'update'])->syncRoles([$this->role]);
        Permission::create(['name' => 'staff.delete', 'description' => 'Eliminar', 'module' => 'Personal', 'action' => 'delete'])->syncRoles([$this->role]);

        Permission::create(['name' => 'user.create', 'description' => 'Crear', 'module' => 'Usuario', 'action' => 'create'])->syncRoles([$this->role]);
        Permission::create(['name' => 'user.update', 'description' => 'Editar', 'module' => 'Usuario', 'action' => 'update'])->syncRoles([$this->role]);
        Permission::create(['name' => 'user.delete', 'description' => 'Eliminar', 'module' => 'Usuario', 'action' => 'delete'])->syncRoles([$this->role]);

        $this->user = User::factory()->create();
        $this->user->assignRole('Administrador');

        //Create example data
        $this->user = User::factory()->create()->assignRole($this->role);
        $this->another_user = User::factory()->create()->assignRole($this->role);

        $this->staff = Staff::factory()->create();

        $this->staffWithUser = Staff::factory()->create();
        $this->userWithStaff = User::create([
            'email' => 'javier@gmail.com',
            'password' => 'Test.123',
            'staff_id' => $this->staffWithUser->id,
        ])->assignRole($this->role);
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
            ->assertRedirect('admin/personal')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Personal creado correctamente');

        // Verify that the user was created in the database
        $this->assertTrue(User::where('email', 'test@gmail.com')->exists());
    }
    public function test_a_user_can_be_created_in_update_staff(): void
    {
        // Create the user in live wire component
        Livewire::test(StaffLivewire\Update::class, ['staff' => $this->staff->id])
            ->set('staff_update.name', 'Cristhian')
            ->set('staff_update.surname', 'Justiniano')
            ->set('staff_update.phone', '75525722')
            ->set('staff_update.CI_number', '13315000')
            ->set('staff_update.CI_extension', 'SC')
            ->set('staff_update.birthdate', '1990-01-01')
            ->set('staff_update.is_employed', false)
            ->set('add_account', 'true')
            ->set('user_create.role', $this->role->id)
            ->set('user_create.email', 'test@gmail.com')
            ->set('user_create.password', 'Test.123')
            ->set('user_create.password_confirmation', 'Test.123')
            ->call('update')
            ->assertRedirect('admin/personal')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Personal actualizado correctamente');

        // Verify that the user was created in the database
        $this->assertTrue(User::where('email', 'test@gmail.com')->exists());
    }
    public function test_can_display_list_of_user(): void
    {
        // Display the list of user
        $response = $this->actingAs($this->user)->get('admin/personal');

        // Verify that the user are displayed
        $response->assertStatus(200);
        $response->assertSee($this->another_user->email);
        $response->assertSee($this->role->name);
    }
    public function test_a_user_can_be_updated(): void
    {
        // Update the user in live wire component
        Livewire::test(StaffLivewire\Update::class, ['staff' => $this->staffWithUser->id])
            ->set('staff_update.name', 'Cristhian')
            ->set('staff_update.surname', 'Justiniano')
            ->set('staff_update.phone', '75525722')
            ->set('staff_update.CI_number', '13315000')
            ->set('staff_update.CI_extension', 'SC')
            ->set('staff_update.birthdate', '1990-01-01')
            ->set('staff_update.is_employed', false)
            ->set('user_update.role', $this->role->id)
            ->set('user_update.email', 'prueba@gmail.com')
            ->call('update')
            ->assertRedirect('admin/personal')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Personal actualizado correctamente');

        // Verify that the user was created in the database
        $this->assertTrue(User::where('email', 'prueba@gmail.com')->exists());
    }

    public function test_can_view_user_details()
    {
        // Display the user details in personal view
        $response = $this->actingAs($this->user)->get('admin/personal/' . $this->staffWithUser->id);

        // Verify that the user details are displayed
        $response->assertStatus(200);
        $response->assertSee($this->userWithStaff->email);
        $response->assertSee($this->role->name);
    }
}
