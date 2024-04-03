<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;

class ProductManageTest extends TestCase
{
    use RefreshDatabase;

    protected $category;
    protected $product;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->product = Product::factory()->create([
            'price' => 100.5
        ]);
    }



    public function test_can_display_list_of_products(): void
    {
        // Display the list of products
        $response = $this->actingAs($this->user)->get('/productos');

        // Verify that the products are displayed
        $response->assertStatus(200);
        $response->assertSee($this->product->id);
        $response->assertSee(Carbon::parse($this->product->created_at)->isoFormat('DD MMM YYYY'));
        $response->assertSee($this->product->name);
        $response->assertSee($this->product->price);
    }
}
