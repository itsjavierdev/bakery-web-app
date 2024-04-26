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
use App\Livewire\Admin\Sales;
use App\Models\User;

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


        $this->user = User::factory()->create();
        //Create example data
        $this->product = Product::factory()->create();

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

    public function test_a_order_can_be_created(): void
    {
        $this->actingAs($this->user);

        Livewire::test(Sales\Create::class)
            ->set('customer', ['id' => $this->customer->id, 'name' => $this->customer->name])
            ->set('total_paid', 100)
            ->call('addProduct', $this->product->id)
            ->call('save')
            ->assertRedirect('admin/ventas')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Venta creada correctamente');

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
}
