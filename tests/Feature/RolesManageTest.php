<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Livewire\Admin\Roles;
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

    protected function setUp(): void
    {
        parent::setUp();

        //Create example data
        $this->user = User::factory()->create();

        $this->permissionCreate = Permission::create(['name' => 'roles.create', 'description' => 'Crear', 'module' => 'Roles', 'action' => 'create']);
        $this->permissionEdit = Permission::create(['name' => 'roles.edit', 'description' => 'Editar', 'module' => 'Roles', 'action' => 'edit']);

        $this->role = Role::create(['name' => 'Administrador']);
        $this->role->givePermissionTo($this->permissionCreate);
    }


    public function test_a_role_can_be_created(): void
    {
        // Create the role in live wire component
        Livewire::test(Roles\Create::class)
            ->set('name', 'Repartidor')
            ->set('selected_permissions', [$this->permissionCreate->id])
            ->call('save')
            ->assertRedirect('roles')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Rol creado correctamente');

        // Verify that the role was created in the database
        $this->assertTrue(Role::where('name', 'Repartidor')->exists());

        // Verify that the role has the permission assigned
        $role = Role::where('name', 'Repartidor')->first();
        $this->assertTrue($role->hasPermissionTo('roles.create'));
    }

    public function test_can_display_list_of_roles(): void
    {
        // Display the list of roles
        $response = $this->actingAs($this->user)->get('/roles');

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
            ->assertRedirect('roles')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Rol actualizado correctamente');

        // Verify that the role was updated in the database
        $this->assertTrue(Role::where('name', 'Super Admin')->exists());

        // Verify that the role has the permission assigned
        $role = Role::where('name', 'Super Admin')->first();
        $this->assertTrue($role->hasPermissionTo('roles.edit'));
        $this->assertFalse($role->hasPermissionTo('roles.create'));
    }

    public function test_a_role_can_be_deleted()
    {
        // Exceute the delete action in the live wire component
        Livewire::test(Roles\Delete::class)
            ->call('confirmDelete', $this->role->id)
            ->assertSet('delete_id', $this->role->id)
            ->assertSet('open', true)
            ->call('delete', $this->role->id)
            ->assertDispatched('render')
            ->assertDispatched('banner-message', style: 'success', message: 'Rol eliminado correctamente');

        // Verify that the role was deleted from the database
        $this->assertFalse(Role::where('id', $this->role->id)->exists());
    }

    public function test_can_view_role_details()
    {
        // Display the role details
        $response = $this->actingAs($this->user)->get('/roles/' . $this->role->id);

        // Verify that the role details are displayed
        $response->assertStatus(200);
        $response->assertSee($this->role->name);
        $response->assertSee(Carbon::parse($this->role->created_at)->isoFormat('DD MMM YYYY'));
        $response->assertSee(Carbon::parse($this->role->updated_at)->isoFormat('DD MMM YYYY'));
        $response->assertSee($this->permissionCreate->module);
        $response->assertSee($this->permissionCreate->description);
    }
}
