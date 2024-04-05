<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Livewire\Products as ProductsLivewire;
use App\Models\Product;
use App\Models\ProductImage;
use Carbon\Carbon;
use Livewire\Livewire;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Livewire\UploadPhoto;

class ProductManageTest extends TestCase
{
    use RefreshDatabase;

    protected $category;
    protected $product;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::factory()->create();

        $this->user = User::factory()->create();
        $this->product = Product::factory()->create([
            'price' => 100.5,
            'category_id' => $this->category->id,
        ]);
    }

    public function test_a_product_can_be_created(): void
    {
        Storage::fake('products');

        $images = [
            UploadedFile::fake()->image('product1.jpg'),
            UploadedFile::fake()->image('product2.jpg'),
        ];

        // Create the product in live wire component
        Livewire::test(ProductsLivewire\Create::class)
            ->set('name', 'Rollito')
            ->set('category_id', $this->category->id)
            ->set('price', 12.5)
            ->set('bag_quantity', '20')
            ->set('description', 'lorem ipsum')
            ->set('images', [UploadedFile::fake()->image('avatar.jpg')])
            ->call('save')
            ->assertRedirect('productos')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Producto creado correctamente');

        // Verify that the product was created in the database
        $this->assertTrue(Product::where('name', 'Rollito')->exists());
        $this->assertTrue(Product::where('category_id', $this->category->id)->exists());
        $this->assertTrue(Product::where('price', 12.5)->exists());
        $this->assertTrue(Product::where('bag_quantity', '20')->exists());
        $this->assertTrue(Product::where('description', 'lorem ipsum')->exists());
        $product = Product::where('name', 'Rollito')->first();

        $this->assertTrue(ProductImage::where('product_id', $product->id)->exists());


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

    public function test_can_view_product_details()
    {
        // Display the product details
        $response = $this->actingAs($this->user)->get('/productos/' . $this->product->id);

        // Verify that the product details are displayed
        $response->assertStatus(200);
        $response->assertSee($this->product->id);
        $response->assertSee($this->product->name);
        $response->assertSee($this->product->price);
        $response->assertSee($this->product->bag_quantity);
        $response->assertSee($this->product->description);
        $response->assertSee($this->product->slug);
        $response->assertSee($this->category->name);
        $response->assertSee(Carbon::parse($this->product->created_at)->isoFormat('DD MMM YYYY'));
        $response->assertSee(Carbon::parse($this->product->updated_at)->isoFormat('DD MMM YYYY'));
    }
}
