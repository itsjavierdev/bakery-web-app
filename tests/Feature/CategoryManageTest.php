<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use Livewire\Livewire;
use App\Livewire\Categories as CategoriesLivewire;
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
    public function test_a_category_can_be_created(): void
    {
        // Create the categorie in live wire component
        Livewire::test(CategoriesLivewire\Create::class)
            ->set('name', 'Empanadas')
            ->call('save')
            ->assertRedirect('categorias')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Categoría creada correctamente');

        // Verify that the categorie was created in the database
        $this->assertTrue(Category::where('name', 'Empanadas')->exists());
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
