<?php

namespace Tests\Feature;


use App\Models\SaleDetail;
use App\Models\Staff;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use SebastianBergmann\Type\VoidType;
use Tests\TestCase;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Product;
use Livewire\Livewire;
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
}
