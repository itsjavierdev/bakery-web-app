<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FeaturedManageTest extends TestCase
{
    public $user;
    public $featured;
    public $product;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = \App\Models\User::factory()->create();
        $this->featured = \App\Models\Featured::factory()->create();
        $this->product = Product::where('id', $this->featured->product_id)->first();
    }

    public function test_can_display_list_of_featured()
    {
        $response = $this->actingAs($this->user)->get('admin/destacados');

        $response->assertStatus(200);
        $response->assertSee($this->featured->title);
        $response->assertSee($this->product->name);
    }
}
