<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Customer;
use App\Models\CustomerAccount;
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
