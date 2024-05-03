<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Customer;
use App\Models\User;
use App\Models\CustomerAccount;
use Livewire\Livewire;
use App\Livewire\Admin\ManagementCustomers\Customers as CustomersLivewire;
use Carbon\Carbon;

class CustomersManageTest extends TestCase
{
    use RefreshDatabase;
    protected $user;
    protected $customer;
    protected $customer_account;

    protected function setUp(): void
    {
        parent::setUp();

        //Create example data
        $this->user = User::factory()->create();

        $this->customer = Customer::create([
            'name' => 'Javier',
            'surname' => 'Vargas',
            'phone' => '62345678',
            'email' => 'javier@gmail.com',
        ]);
        $this->customer_account = CustomerAccount::create([
            'customer_id' => $this->customer->id,
            'password' => '12345678',
        ]);
    }

    public function test_a_customer_can_be_created()
    {
        // Create the customer in live wire component
        Livewire::test(CustomersLivewire\Create::class)
            ->set('name', 'Javier')
            ->set('surname', 'Vargas')
            ->set('phone', '62356455')
            ->set('email', 'juan@email.com')
            ->call('save')
            ->assertRedirect('admin/clientes')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Cliente creado correctamente');

        // Verify that the customer was created in the database
        $this->assertTrue(Customer::where('name', 'Javier')->exists());
    }

    public function test_can_display_list_of_customers()
    {
        // Display the list of customers
        $response = $this->actingAs($this->user)->get('admin/clientes');

        // Verify that the customer is displayed
        $response->assertStatus(200);
        $response->assertSee($this->customer->name);
        $response->assertSee($this->customer->surname);
        $response->assertSee($this->customer->phone);
        $response->assertSee($this->customer->email);
        $response->assertSee(Carbon::parse($this->customer->created_at)->isoFormat('DD MMM YYYY'));
    }


    public function test_a_customer_can_be_updated()
    {
        // Update the customer in live wire component
        Livewire::test(CustomersLivewire\Update::class, ['customer' => $this->customer])
            ->set('name', 'Javier')
            ->set('surname', 'Vargas')
            ->set('phone', '66345678')
            ->set('email', 'javier@email.com')
            ->call('update')
            ->assertRedirect('admin/clientes')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Cliente actualizado correctamente');

        // Verify that the customer was updated in the database
        $this->assertTrue(Customer::where('name', 'Javier')->exists());
        $this->assertTrue(Customer::where('surname', 'Vargas')->exists());
        $this->assertTrue(Customer::where('phone', '66345678')->exists());
        $this->assertTrue(Customer::where('email', 'javier@email.com')->exists());
    }

    public function test_a_customer_can_be_deleted()
    {
        // Exceute the delete action in the live wire component
        Livewire::test(CustomersLivewire\Delete::class)
            ->call('confirmDelete', $this->customer->id)
            ->assertSet('delete_id', $this->customer->id)
            ->assertSet('open', true)
            ->call('delete', $this->customer->id)
            ->assertDispatched('render')
            ->assertDispatched('banner-message', style: 'success', message: 'Cliente eliminado correctamente');

        // Verify that the customer was deleted from the database
        $this->assertFalse(Customer::where('id', $this->customer->id)->exists());
    }

    public function test_can_view_customer_details()
    {
        // Display the customer details
        $response = $this->actingAs($this->user)->get('admin/clientes/' . $this->customer->id);

        // Verify that the customer details are displayed
        $response->assertStatus(200);
        $response->assertSee($this->customer->id);
        $response->assertSee($this->customer->name);
        $response->assertSee($this->customer->surname);
        $response->assertSee($this->customer->phone);
        $response->assertSee($this->customer->email);
        $response->assertSee(Carbon::parse($this->customer->created_at)->isoFormat('DD MMM YYYY'));
        $response->assertSee(Carbon::parse($this->customer->updated_at)->isoFormat('DD MMM YYYY'));
    }
}
