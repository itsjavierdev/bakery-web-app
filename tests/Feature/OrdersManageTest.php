<?php

namespace Tests\Feature;

use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Sale;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Address;
use App\Models\Product;
use App\Models\DeliveryTime;
use App\Livewire\Admin\Transactions\Orders;
use Livewire\Livewire;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class OrdersManageTest extends TestCase
{
    use RefreshDatabase;


    protected $user;
    protected $order;
    protected $order_without_payment;
    protected $address;
    protected $customer;
    protected $product;
    protected $delivery_time;
    protected $order_detail;
    protected $order_detail_without_payment;

    protected function setUp(): void
    {
        parent::setUp();

        $role = Role::create(['name' => 'Administrador']);

        Permission::create(['name' => 'orders.create', 'description' => 'Crear', 'module' => 'Pedidos', 'action' => 'create'])->syncRoles([$role]);
        Permission::create(['name' => 'orders.read', 'description' => 'Ver', 'module' => 'Pedidos', 'action' => 'read'])->syncRoles([$role]);
        Permission::create(['name' => 'orders.update', 'description' => 'Editar', 'module' => 'Pedidos', 'action' => 'update'])->syncRoles([$role]);
        Permission::create(['name' => 'orders.delete', 'description' => 'Eliminar', 'module' => 'Pedidos', 'action' => 'delete'])->syncRoles([$role]);
        Permission::create(['name' => 'orders.delivery', 'description' => 'Enviar', 'module' => 'Pedidos', 'action' => 'delivery'])->syncRoles([$role]);

        $this->user = User::factory()->create();
        $this->user->assignRole('Administrador');

        $this->product = Product::factory()->create([
            'price' => 100
        ]);

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
            'total' => 200,
            'address_id' => $this->address->id,
            'customer_id' => $this->customer->id,
            'total_quantity' => 1,
            'paid' => 1,
            'picked_up' => 0,
            'paid_amount' => 100,
        ]);

        $this->order_without_payment = Order::create([
            'delivery_date' => '2021-01-01',
            'delivery_time_id' => $this->delivery_time->id,
            'total' => 100,
            'address_id' => $this->address->id,
            'customer_id' => $this->customer->id,
            'total_quantity' => 1,
            'paid' => 0,
            'picked_up' => 0,
            'paid_amount' => null,
        ]);

        $this->order_detail = OrderDetail::create([
            'order_id' => $this->order->id,
            'product_id' => $this->product->id,
            'quantity' => 1,
            'by_bag' => 0,
            'product_price' => 100,
            'subtotal' => 100,
        ]);

        $this->order_detail_without_payment = OrderDetail::create([
            'order_id' => $this->order_without_payment->id,
            'product_id' => $this->product->id,
            'quantity' => 1,
            'by_bag' => 0,
            'product_price' => 100,
            'subtotal' => 100,
        ]);
    }

    public function test_a_order_can_be_created(): void
    {
        Livewire::test(Orders\Create::class)
            ->set('customer', ['id' => $this->customer->id, 'name' => $this->customer->name])
            ->set('address', ['id' => $this->address->id, 'address' => $this->address->address])
            ->set('notes', 'Some notes')
            ->set('total_paid', 100)
            ->set('delivery_time', $this->delivery_time->id)
            ->set('delivery_date', now()->addDays(1)->toDateString())
            ->call('addProduct', $this->product->id)
            ->call('save')
            ->assertRedirect('admin/pedidos')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Pedido creado correctamente');

        // Verify that the order was created in the database
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
            ->set('total_paid', 100)
            ->set('delivery_time', $this->delivery_time->id)
            ->set('delivery_date', now()->addDays(1)->toDateString())
            ->call('addProduct', $this->product->id)
            ->call('update')
            ->assertRedirect('admin/pedidos')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Pedido actualizado correctamente');

        // Verify that the order was updated in the database
        $this->assertTrue(Order::where('notes', 'other note')->exists());
    }

    public function test_can_view_orders_details(): void
    {
        // Display the order details
        $response = $this->actingAs($this->user)->get('admin/pedidos/' . $this->order->id);

        // Verify that the order details are displayed
        $response->assertStatus(200);
        $response->assertSee($this->order->id);
        $response->assertSee($this->customer->name);
        $response->assertSee($this->customer->surname);
        $response->assertSee($this->order->total);
        $response->assertSee($this->product->name);
        $response->assertSee($this->order_detail->quantity);
        $response->assertSee($this->order_detail->product_price);
        $response->assertSee($this->order_detail->subtotal);
    }

    public function test_a_order_can_be_delivered(): void
    {

        $this->actingAs($this->user);
        // Verify that the order is not delivered
        $this->assertFalse(Order::where('id', $this->order->id)->where('delivered', true)->exists());

        Livewire::test(Orders\Deliver::class)
            ->call('delivery', $this->order->id)
            ->set('new_paid', 50)
            ->call('deliver')
            ->assertDispatched('render')
            ->assertDispatched('banner-message', style: 'success', message: 'Pedido entregado correctamente');

        // Verify that the order was delivered in the database
        $this->assertTrue(Order::where('id', $this->order->id)->where('delivered', true)->exists());
        $this->assertTrue(Sale::where('total', $this->order->total)->exists());
        $this->assertTrue(Payment::where('amount', 50)->exists());
        $this->assertTrue(Payment::where('amount', 100)->exists());

    }

    public function test_a_order_can_be_deleted(): void
    {
        // Verify that the order exists in the database
        $this->assertTrue(Order::where('id', $this->order_without_payment->id)->exists());
        $this->assertTrue(OrderDetail::where('order_id', $this->order_without_payment->id)->exists());

        Livewire::test(Orders\Delete::class)
            ->call('confirmDelete', $this->order_without_payment->id)
            ->assertSet('delete_id', $this->order_without_payment->id)
            ->assertSet('open', true)
            ->call('delete', $this->order_without_payment->id)
            ->assertDispatched('render')
            ->assertDispatched('banner-message', style: 'success', message: 'Pedido eliminado correctamente');

        // Verify that the order was deleted from the database
        $this->assertFalse(Order::where('id', $this->order_without_payment->id)->exists());
        $this->assertFalse(OrderDetail::where('order_id', $this->order_without_payment->id)->exists());
    }
}
