<?php

namespace Tests\Feature;

use App\Models\Featured;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Livewire\Admin\Parameters\Featured as FeaturedLivewire;
use Livewire\Livewire;
use Tests\TestCase;

class FeaturedManageTest extends TestCase
{
    use RefreshDatabase;
    public $user;
    public $featured;
    public $product;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->featured = Featured::factory()->create();
        $this->product = Product::where('id', $this->featured->product_id)->first();
    }

    public function test_a_featured_can_be_created(): void
    {
        Storage::fake('featureds');

        // Create the featured in live wire component
        Livewire::test(FeaturedLivewire\Create::class)
            ->set('title', 'Rollito')
            ->set('product', $this->product)
            ->set('put_filter', true)
            ->set('image', UploadedFile::fake()->image('avatar.jpg'))
            ->call('save')
            ->assertRedirect('admin/destacados')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Imagen destacada creada correctamente');

        // Assert the featured was created
        $this->assertTrue(Featured::where('title', 'Rollito')->exists());
        $this->assertTrue(Featured::where('product_id', $this->product->id)->exists());
        $this->assertTrue(Featured::where('has_filter', 1)->exists());
    }

    public function test_can_display_list_of_featured(): void
    {
        $response = $this->actingAs($this->user)->get('admin/destacados');

        $response->assertStatus(200);
        $response->assertSee($this->featured->title);
        $response->assertSee($this->product->name);
    }
}
