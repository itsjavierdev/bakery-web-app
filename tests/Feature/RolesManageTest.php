<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Livewire\Admin\ManagementAdmin\Roles;
use Carbon\Carbon;

class RolesManageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    protected $user;
    protected $permissionCreate;
    protected $permissionEdit;
    protected $role;
    protected $role_without_users;

    protected function setUp(): void
    {
        parent::setUp();

        //Create example data
        $role = Role::create(['name' => 'Roles']);

        $this->permissionCreate = Permission::create(['name' => 'roles.create', 'description' => 'Crear', 'module' => 'Roles', 'action' => 'create'])->syncRoles([$role]);
        $this->permissionRead = Permission::create(['name' => 'roles.read', 'description' => 'Ver', 'module' => 'Roles', 'action' => 'read'])->syncRoles([$role]);
        $this->permissionEdit = Permission::create(['name' => 'roles.update', 'description' => 'Editar', 'module' => 'Roles', 'action' => 'update'])->syncRoles([$role]);

        $this->user = User::factory()->create();
        $this->user->assignRole('Roles');


        $this->role = Role::create(['name' => 'Administrador']);
        $this->role->givePermissionTo($this->permissionCreate);
        $this->role_without_users = Role::create(['name' => 'Repartidor']);
    }


    public function test_a_role_can_be_created(): void
    {
        // Create the role in live wire component
        Livewire::test(Roles\Create::class)
            ->set('name', 'Vendedor')
            ->set('selected_permissions', [$this->permissionCreate->id])
            ->call('save')
            ->assertRedirect('admin/roles')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Rol creado correctamente');

        // Verify that the role was created in the database
        $this->assertTrue(Role::where('name', 'Repartidor')->exists());

        // Verify that the role has the permission assigned
        $role = Role::where('name', 'Vendedor')->first();
        $this->assertTrue($role->hasPermissionTo('roles.create'));
    }

    public function test_can_display_list_of_roles(): void
    {
        // Display the list of roles
        $response = $this->actingAs($this->user)->get('admin/roles');

        // Verify that the roles are displayed
        $response->assertStatus(200);
        $response->assertSee('Administrador');
    }
    public function test_a_role_can_be_updated()
    {
        // Update the role in live wire component
        Livewire::test(Roles\Update::class, ['role' => $this->role->id])
            ->set('name', 'Super Admin')
            ->set('selected_permissions', [$this->permissionEdit->id])
            ->call('update')
            ->assertRedirect('admin/roles')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Rol actualizado correctamente');

        // Verify that the role was updated in the database
        $this->assertTrue(Role::where('name', 'Super Admin')->exists());

        // Verify that the role has the permission assigned
        $role = Role::where('name', 'Super Admin')->first();
        $this->assertTrue($role->hasPermissionTo('roles.update'));
        $this->assertFalse($role->hasPermissionTo('roles.create'));
    }

    public function test_a_role_can_be_deleted()
    {
        // Exceute the delete action in the live wire component
        Livewire::test(Roles\Delete::class)
            ->call('confirmDelete', $this->role_without_users->id)
            ->assertSet('delete_id', $this->role_without_users->id)
            ->assertSet('open', true)
            ->call('delete', $this->role_without_users->id)
            ->assertDispatched('render')
            ->assertDispatched('banner-message', style: 'success', message: 'Rol eliminado correctamente');

        // Verify that the role was deleted from the database
        $this->assertFalse(Role::where('id', $this->role_without_users->id)->exists());
    }

    public function test_can_view_role_details()
    {
        // Display the role details
        $response = $this->actingAs($this->user)->get('admin/roles/' . $this->role->id);

        // Verify that the role details are displayed
        $response->assertStatus(200);
        $response->assertSee($this->role->name);
        $response->assertSee(Carbon::parse($this->role->created_at)->isoFormat('DD MMM YYYY'));
        $response->assertSee($this->permissionCreate->module);
        $response->assertSee($this->permissionCreate->description);
    }
}
