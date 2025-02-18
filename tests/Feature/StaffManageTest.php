<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use App\Livewire\Admin\ManagementAdmin\Staff as StaffLivewire;
use App\Models\User;
use App\Models\Staff;
use Tests\TestCase;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class StaffManageTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $staff;

    protected function setUp(): void
    {
        parent::setUp();

        //Create example data$role = Role::create(['name' => 'Administrador']);

        $role = Role::create(['name' => 'Administrador']);

        Permission::create(['name' => 'staff.create', 'description' => 'Crear', 'module' => 'Personal', 'action' => 'create'])->syncRoles([$role]);
        Permission::create(['name' => 'staff.read', 'description' => 'Ver', 'module' => 'Personal', 'action' => 'read'])->syncRoles([$role]);
        Permission::create(['name' => 'staff.update', 'description' => 'Editar', 'module' => 'Personal', 'action' => 'update'])->syncRoles([$role]);
        Permission::create(['name' => 'staff.delete', 'description' => 'Eliminar', 'module' => 'Personal', 'action' => 'delete'])->syncRoles([$role]);

        $this->user = User::factory()->create();
        $this->user->assignRole('Administrador');

        $this->staff = Staff::create([
            'name' => 'Javier',
            'surname' => 'Vargas',
            'phone' => '12345678',
            'CI' => '12345678 SC',
            'birthdate' => '1990-01-01',
        ]);
    }
    public function test_a_staff_can_be_created(): void
    {
        // Create the staff in live wire component
        Livewire::test(StaffLivewire\Create::class)
            ->set('staff_create.name', 'Cristhian')
            ->set('staff_create.surname', 'Justiniano')
            ->set('staff_create.phone', '75525722')
            ->set('staff_create.CI_number', '13315000')
            ->set('staff_create.CI_extension', 'SC')
            ->set('staff_create.birthdate', '1990-01-01')
            ->call('save')
            ->assertRedirect('admin/personal')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Personal creado correctamente');

        // Verify that the staff was created in the database
        $this->assertTrue(Staff::where('name', 'Cristhian')->exists());
        $this->assertTrue(Staff::where('surname', 'Justiniano')->exists());
        $this->assertTrue(Staff::where('phone', '75525722')->exists());
        $this->assertTrue(Staff::where('CI', '13315000 SC')->exists());
        $this->assertTrue(Staff::where('birthdate', '1990-01-01')->exists());
    }


    public function test_can_display_list_of_staff(): void
    {
        // Display the list of staff
        $response = $this->actingAs($this->user)->get('admin/personal');

        // Verify that the staff are displayed
        $response->assertStatus(200);
        $response->assertSee('Javier');
        $response->assertSee('Vargas');
    }
    public function test_a_staff_can_be_updated()
    {
        // Update the staff in live wire component
        Livewire::test(StaffLivewire\Update::class, ['staff' => $this->staff->id])
            ->set('staff_update.name', 'Mario')
            ->set('staff_update.surname', 'Vargas')
            ->set('staff_update.phone', '75525723')
            ->set('staff_update.CI_number', '13315002')
            ->set('staff_update.CI_extension', 'LP')
            ->set('staff_update.birthdate', '1990-01-12')
            ->set('staff_update.is_employed', false)
            ->call('update')
            ->assertRedirect('admin/personal')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Personal actualizado correctamente');

        // Verify that the staff was updated in the database
        $this->assertTrue(Staff::where('name', 'Mario')->exists());
        $this->assertTrue(Staff::where('surname', 'Vargas')->exists());
        $this->assertTrue(Staff::where('phone', '75525723')->exists());
        $this->assertTrue(Staff::where('CI', '13315002 LP')->exists());
        $this->assertTrue(Staff::where('birthdate', '1990-01-12')->exists());
        $this->assertTrue(Staff::where('is_employed', '0')->exists());

    }

    public function test_a_staff_can_be_deleted()
    {
        // Exceute the delete action in the live wire component
        Livewire::test(StaffLivewire\Delete::class)
            ->call('confirmDelete', $this->staff->id)
            ->assertSet('delete_id', $this->staff->id)
            ->assertSet('open', true)
            ->call('delete', $this->staff->id)
            ->assertDispatched('render')
            ->assertDispatched('banner-message', style: 'success', message: 'Personal eliminado correctamente');

        // Verify that the staff was deleted from the database
        $this->assertFalse(Staff::where('id', $this->staff->id)->exists());
    }


    public function test_can_view_staff_details()
    {
        // Display the staff details
        $response = $this->actingAs($this->user)->get('admin/personal/' . $this->staff->id);

        // Verify that the staff details are displayed
        $response->assertStatus(200);
        $response->assertSee($this->staff->id);
        $response->assertSee($this->staff->name);
        $response->assertSee($this->staff->surname);
        $response->assertSee($this->staff->phone);
        $response->assertSee($this->staff->CI);
        $response->assertSee(Carbon::parse($this->staff->birthdate)->isoFormat('DD MMM YYYY'));
        $response->assertSee(Carbon::parse($this->staff->created_at)->isoFormat('DD MMM YYYY'));
    }
}
