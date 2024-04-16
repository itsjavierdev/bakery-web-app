<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Customer;
use App\Models\CustomerAccount;
use App\Livewire\Admin\Customers as CustomersLivewire;
use Carbon\Carbon;

class CustomersManageTest extends TestCase
{
    protected $customer;
    protected $customer_account;

    protected function setUp(): void
    {
        parent::setUp();

        //Create example data
        $this->customer = Customer::create([
            'name' => 'Javier',
            'surname' => 'Vargas',
            'phone' => '12345678',
            'birthdate' => '1990-01-01',
        ]);
        $this->customer_account = CustomerAccount::create([
            'customer_id' => $this->customer->id,
            'email' => 'javier@gmail.com',
            'password' => '12345678',
        ]);
    }

    protected function test_a_customer_can_be_created()
    {
        // Create the customer in live wire component
        Livewire::test(CustomersLivewire\Create::class)
            ->set('name', 'Javier')
            ->set('surname', 'Vargas')
            ->set('phone', '12345678')
            ->call('save')
            ->assertRedirect('admin/clientes')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Cliente creado correctamente');

        // Verify that the customer was created in the database
        $this->assertTrue(Customer::where('name', 'Javier')->exists());
    }

    protected function test_can_display_list_of_customers()
    {
        // Display the list of customers
        $response = $this->actingAs($this->customer)->get('admin/clientes');

        // Verify that the customer is displayed
        $response->assertStatus(200);
        $response->assertSee($this->customer->name);
        $response->assertSee($this->customer->surname);
        $response->assertSee($this->customer->phone);
        $response->assertSee($this->customer_account->email);
        $response->assertSee(Carbon::parse($this->customer->created_at)->isoFormat('DD MMM YYYY'));
    }

}
