<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use App\Models\User;

class CategoryManageTest extends TestCase
{
    use RefreshDatabase;

    protected $category;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
    }


    public function test_can_display_list_of_categories(): void
    {
        // Display the list of categories
        $response = $this->actingAs($this->user)->get('/categorias');

        // Verify that the categories are displayed
        $response->assertStatus(200);
        $response->assertSee($this->category->name);
    }

}
