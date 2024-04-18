<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Address;
use App\Models\DeliveryTime;
use App\Models\User;

class OrdersManageTest extends TestCase
{
    use RefreshDatabase;


    protected $user;
    protected $order;
    protected $address;
    protected $customer;
    protected $delivery_time;

    protected function setUp(): void
    {
        parent::setUp();


        $this->user = User::factory()->create();
        //Create example data
        $this->delivery_time = DeliveryTime::create([
            'time' => '10:00',
            'available' => true
        ]);

        $this->customer = Customer::create([
            'name' => 'Juan',
            'surname' => 'Perez',
            'phone' => '12345678',
            'email' => 'exmaple@test.com',
        ]);

        $this->address = Address::create([
            'address' => 'Calle 123',
            'reference' => 'reja ploma',
            'customer_id' => $this->customer->id,
        ]);


        $this->order = Order::create([
            'delivery_date' => '2021-01-01',
            'delivery_time_id' => $this->delivery_time->id,
            'total' => 100,
            'address_id' => $this->address->id,
            'customer_id' => $this->customer->id,
            'paid' => 1,
            'paid_amount' => 100,
        ]);
    }

    public function test_can_display_list_of_orders(): void
    {
        // Display the list of orders
        $response = $this->actingAs($this->user)->get('admin/pedidos');

        // Verify that the orders are displayed
        $response->assertStatus(200);
        $response->assertSee($this->order->id);
        $response->assertSee($this->customer->name);
        $response->assertSee($this->customer->surname);
        $response->assertSee($this->order->total);
    }
}
