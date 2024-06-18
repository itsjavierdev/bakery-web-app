<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Address;
use App\Models\CompanyContact;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;
use App\Livewire\Admin\Parameters\CompanyContact as CompanyContactLivewire;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CompanyContactManageTest extends TestCase
{

    use RefreshDatabase;
    public $company_contact;
    public $address;
    public $user;

    public function setUp(): void
    {
        parent::setUp();

        $role = Role::create(['name' => 'Administrador']);

        Permission::create(['name' => 'companycontact.read', 'description' => 'Ver', 'module' => 'Información de contacto', 'action' => 'read'])->syncRoles([$role]);
        Permission::create(['name' => 'companycontact.update', 'description' => 'Editar', 'module' => 'Información de contacto', 'action' => 'update'])->syncRoles([$role]);

        $this->user = User::factory()->create();
        $this->user->assignRole('Administrador');

        $this->address = Address::create([
            'address' => 'Bolivar 123',
        ]);

        $this->company_contact = CompanyContact::create([
            'phone' => '123456789',
            'email' => 'empresa@gmail.com',
            'address_id' => $this->address->id,
        ]);
    }

    public function test_company_contact_can_be_displayed(): void
    {
        // get the company contact view
        $response = $this->actingAs($this->user)->get('admin/informacion');

        // assert the company contact is displayed
        $response->assertStatus(200);
        $response->assertSee('123456789');
        $response->assertSee('empresa@gmail.com');
        $response->assertSee('Bolivar 123');
    }

    public function test_company_contact_can_be_updated(): void
    {
        Livewire::test(CompanyContactLivewire\Update::class)
            ->set('phone', '75528999')
            ->set('email', 'javier@gmail.com')
            ->set('new_address', 'Bolivar 456')
            ->call('update')
            ->assertRedirect('admin/informacion')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Contacto de la empresa actualizado correctamente');

        $this->assertTrue(CompanyContact::where('phone', '75528999')->exists());
        $this->assertTrue(CompanyContact::where('email', 'javier@gmail.com')->exists());

    }

}
