<?php

namespace Tests\Feature;


use App\Models\SaleDetail;
use App\Models\Staff;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Product;
use Livewire\Livewire;
use App\Livewire\Admin\Transactions\Sales;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SalesManageTest extends TestCase
{
    use RefreshDatabase;


    protected $user;
    protected $sale;
    protected $customer;
    protected $staff;
    protected $product;
    protected $sale_detail;

    protected function setUp(): void
    {
        parent::setUp();


        $role = Role::create(['name' => 'Administrador']);

        Permission::create(['name' => 'sales.create', 'description' => 'Crear', 'module' => 'Ventas', 'action' => 'create'])->syncRoles([$role]);
        Permission::create(['name' => 'sales.read', 'description' => 'Ver', 'module' => 'Ventas', 'action' => 'read'])->syncRoles([$role]);
        Permission::create(['name' => 'sales.update', 'description' => 'Editar', 'module' => 'Ventas', 'action' => 'update'])->syncRoles([$role]);
        Permission::create(['name' => 'sales.delete', 'description' => 'Eliminar', 'module' => 'Ventas', 'action' => 'delete'])->syncRoles([$role]);

        $this->user = User::factory()->create();
        $this->user->assignRole('Administrador');
        //Create example data
        $this->product = Product::factory()->create(
            [
                'price' => 100,
            ]
        );

        $this->staff = Staff::factory()->create();

        $this->customer = Customer::create([
            'name' => 'Juan',
            'surname' => 'Perez',
            'phone' => '12345678',
            'email' => 'exmaple@test.com',
        ]);

        $this->sale = Sale::create([
            'total' => 100,
            'customer_id' => $this->customer->id,
            'staff_id' => $this->staff->id,
            'paid' => 1,
            'total_quantity' => 1,
            'paid_amount' => 100,
        ]);

        $this->sale_detail = SaleDetail::create([
            'sale_id' => $this->sale->id,
            'product_id' => $this->product->id,
            'quantity' => 1,
            'by_bag' => 0,
            'product_price' => 100,
            'subtotal' => 100,
        ]);
    }

    public function test_a_sale_can_be_created(): void
    {
        $this->actingAs($this->user);

        Livewire::test(Sales\Create::class)
            ->set('customer', ['id' => $this->customer->id, 'name' => $this->customer->name])
            ->set('total_paid', 100)
            ->call('addProduct', $this->product->id)
            ->call('save')
            ->assertRedirect('admin/ventas-realizada/11');

        // Verify that the sale was created in the database
        $this->assertTrue(Sale::where('customer_id', $this->customer->id)->exists());
    }

    public function test_can_display_list_of_sales(): void
    {
        // Display the list of sales
        $response = $this->actingAs($this->user)->get('admin/ventas');

        // Verify that the sales are displayed
        $response->assertStatus(200);
        $response->assertSee($this->sale->id);
        $response->assertSee($this->customer->name);
        $response->assertSee($this->customer->surname);
        $response->assertSee($this->staff->name);
        $response->assertSee($this->staff->surname);
        $response->assertSee($this->sale->total);
    }
    public function test_a_sale_can_be_updated()
    {
        $this->actingAs($this->user);

        $product = Product::factory()->create();

        // Verify that the sale has the product
        $this->assertTrue(Sale::whereHas('products', function ($query) use ($product) {
            $query->where('products.id', $this->product->id);
        })->exists());

        Livewire::test(Sales\Update::class, ['sale' => $this->sale])
            ->set('customer', ['id' => $this->customer->id, 'name' => $this->customer->name])
            ->call('addProduct', $product->id)
            ->call('update')
            ->assertRedirect('admin/ventas')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Venta actualizada correctamente');

        // Verify that the sale was updated with the other product in the database
        $this->assertTrue(Sale::whereHas('products', function ($query) use ($product) {
            $query->where('products.id', $product->id);
        })->exists());
    }

    public function test_can_view_sales_details()
    {
        // Display the sale details
        $response = $this->actingAs($this->user)->get('admin/ventas/' . $this->sale->id);

        // Verify that the sale details are displayed
        $response->assertStatus(200);
        $response->assertSee($this->sale->id);
        $response->assertSee($this->customer->name);
        $response->assertSee($this->customer->surname);
        $response->assertSee($this->staff->name);
        $response->assertSee($this->staff->surname);
        $response->assertSee($this->sale->total);
    }

    public function test_a_sale_can_be_deleted()
    {
        // Verify that the sale exists
        $this->assertTrue(Sale::where('id', $this->sale->id)->exists());

        Livewire::test(Sales\Delete::class)
            ->call('confirmDelete', $this->sale->id)
            ->assertSet('delete_id', $this->sale->id)
            ->assertSet('open', true)
            ->call('delete', $this->sale->id)
            ->assertDispatched('render')
            ->assertDispatched('banner-message', style: 'success', message: 'Venta eliminada correctamente');

        // Verify that the sale was deleted in the database
        $this->assertFalse(Sale::where('id', $this->sale->id)->exists());
    }
}
