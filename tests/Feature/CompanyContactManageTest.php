<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\CompanyContact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use App\Livewire\Admin\Parameters\CompanyContact as CompanyContactLivewire;

class CompanyContactManageTest extends TestCase
{
    public $company_contact;
    public $address;
    public $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

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
