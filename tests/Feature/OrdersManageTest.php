<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use SebastianBergmann\Type\VoidType;
use Tests\TestCase;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Address;
use App\Models\Product;
use App\Models\DeliveryTime;
use App\Livewire\Admin\Orders;
use Livewire\Livewire;
use App\Models\User;

class OrdersManageTest extends TestCase
{
    use RefreshDatabase;


    protected $user;
    protected $order;
    protected $address;
    protected $customer;
    protected $product;
    protected $delivery_time;

    protected function setUp(): void
    {
        parent::setUp();


        $this->user = User::factory()->create();
        //Create example data
        $this->product = Product::factory()->create();

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

    public function test_a_order_can_be_created(): void
    {
        Livewire::test(Orders\Create::class)
            ->set('customer', ['id' => $this->customer->id, 'name' => $this->customer->name])
            ->set('address', ['id' => $this->address->id, 'address' => $this->address->address])
            ->set('notes', 'Some notes')
            ->set('total_paid', 100) // Cambiar según sea necesario
            ->set('delivery_time', $this->delivery_time->id)
            ->set('delivery_date', now()->addDays(1)->toDateString()) // Cambiar según sea necesario
            ->call('addProduct', $this->product->id) // Agregar producto
            ->call('save')
            ->assertRedirect('admin/pedidos')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Pedido creado correctamente');

        // Verify that the product was created in the database
        $this->assertTrue(Order::where('notes', 'Some notes')->exists());
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

    public function test_a_order_can_be_updated(): void
    {
        Livewire::test(Orders\Update::class, ['order' => $this->order])
            ->set('customer', ['id' => $this->customer->id, 'name' => $this->customer->name])
            ->set('address', ['id' => $this->address->id, 'address' => $this->address->address])
            ->set('notes', 'other note')
            ->set('total_paid', 100) // Cambiar según sea necesario
            ->set('delivery_time', $this->delivery_time->id)
            ->set('delivery_date', now()->addDays(1)->toDateString()) // Cambiar según sea necesario
            ->call('addProduct', $this->product->id) // Agregar producto
            ->call('update')
            ->assertRedirect('admin/pedidos')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Pedido actualizado correctamente');

        // Verify that the product was updated in the database
        $this->assertTrue(Order::where('notes', 'other note')->exists());
    }
}
