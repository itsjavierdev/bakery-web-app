<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Livewire\Admin\Parameters\Products as ProductsLivewire;
use App\Models\Product;
use App\Models\ProductImage;
use Carbon\Carbon;
use Livewire\Livewire;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ProductManageTest extends TestCase
{
    use RefreshDatabase;

    protected $category;
    protected $product;
    protected $user;
    protected $product_image;

    protected function setUp(): void
    {
        parent::setUp();


        $role = Role::create(['name' => 'Administrador']);

        Permission::create(['name' => 'products.create', 'description' => 'Crear', 'module' => 'Productos', 'action' => 'create'])->syncRoles([$role]);
        Permission::create(['name' => 'products.read', 'description' => 'Ver', 'module' => 'Productos', 'action' => 'read'])->syncRoles([$role]);
        Permission::create(['name' => 'products.update', 'description' => 'Editar', 'module' => 'Productos', 'action' => 'update'])->syncRoles([$role]);
        Permission::create(['name' => 'products.delete', 'description' => 'Eliminar', 'module' => 'Productos', 'action' => 'delete'])->syncRoles([$role]);

        $this->user = User::factory()->create();
        $this->user->assignRole('Administrador');


        $this->category = Category::factory()->create();

        $this->product = Product::factory()->create([
            'price' => 100.5,
            'category_id' => $this->category->id,
        ]);
        $this->product_image = ProductImage::create([
            'product_id' => $this->product->id,
            'path' => 'products/1.jpg',
            'position' => 1,
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
            ->set('price', 15)
            ->set('bag_quantity', '20')
            ->set('description', 'lorem ipsum')
            ->set('images', [UploadedFile::fake()->image('avatar.jpg')])
            ->call('save')
            ->assertRedirect('admin/productos')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Producto creado correctamente');

        // Verify that the product was created in the database
        $this->assertTrue(Product::where('name', 'Rollito')->exists());
        $this->assertTrue(Product::where('category_id', $this->category->id)->exists());
        $this->assertTrue(Product::where('price', 0.75)->exists());
        $this->assertTrue(Product::where('bag_quantity', '20')->exists());
        $this->assertTrue(Product::where('description', 'lorem ipsum')->exists());
        $product = Product::where('name', 'Rollito')->first();

        $this->assertTrue(ProductImage::where('product_id', $product->id)->exists());


    }

    public function test_can_display_list_of_products(): void
    {
        // Display the list of products
        $response = $this->actingAs($this->user)->get('admin/productos');

        // Verify that the products are displayed
        $response->assertStatus(200);
        $response->assertSee($this->product->id);
        $response->assertSee(Carbon::parse($this->product->created_at)->isoFormat('DD MMM YYYY'));
        $response->assertSee($this->product->name);
        $response->assertSee($this->product->price);
    }

    public function test_a_product_can_be_updated_with_images()
    {
        Storage::fake('products');

        // Update the product in live wire component
        Livewire::test(ProductsLivewire\Update::class, ['product' => $this->product])
            ->set('name', 'Nombre del Producto')
            ->set('category_id', $this->category->id)
            ->set('price', 123.45)
            ->set('bag_quantity', '50')
            ->set('description', 'Nueva descripción del producto')
            ->set('old_images', [$this->product_image])
            ->set('new_images', [UploadedFile::fake()->image('new_image.jpg')])
            ->call('update')
            ->assertRedirect('admin/productos')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Producto actualizado correctamente');


        // Verify that the product was updated in the database
        $this->assertTrue(Product::where('name', 'Nombre del Producto')->exists());
        $this->assertTrue(Product::where('category_id', $this->category->id)->exists());
        $this->assertTrue(Product::where('bag_quantity', '50')->exists());
        $this->assertTrue(Product::where('description', 'Nueva descripción del producto')->exists());

        //verify that the image was updated in the database
        $this->assertDatabaseHas('product_images', [
            'product_id' => $this->product->id,
            'position' => 2,
        ]);

    }

    public function test_a_product_can_be_deleted()
    {
        // Verify that the product an image exists in the database
        $this->assertTrue(Product::where('id', $this->product->id)->exists());
        $this->assertTrue(ProductImage::where('product_id', $this->product->id)->exists());

        // Exceute the delete action in the live wire component
        Livewire::test(ProductsLivewire\Delete::class)
            ->call('confirmDelete', $this->product->id)
            ->assertSet('delete_id', $this->product->id)
            ->assertSet('open', true)
            ->call('delete', $this->product->id)
            ->assertDispatched('render')
            ->assertDispatched('banner-message', style: 'success', message: 'Producto eliminado correctamente');

        // Verify that the product and image was deleted from the database
        $this->assertFalse(Product::where('id', $this->product->id)->exists());
        $this->assertFalse(ProductImage::where('product_id', $this->product->id)->exists());
    }

    public function test_can_view_product_details()
    {
        // Display the product details
        $response = $this->actingAs($this->user)->get('admin/productos/' . $this->product->id);

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
    }
}
