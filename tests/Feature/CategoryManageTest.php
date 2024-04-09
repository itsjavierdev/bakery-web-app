<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use Livewire\Livewire;
use App\Livewire\Categories as CategoriesLivewire;
use App\Models\User;
use Carbon\Carbon;

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

    public function test_a_category_can_be_updated()
    {
        // Update the category in live wire component
        Livewire::test(CategoriesLivewire\Update::class, ['category' => $this->category->id])
            ->set('name', 'Panes')
            ->call('update')
            ->assertRedirect('categorias')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Categoría actualizada correctamente');

        // Verify that the category was updated in the database
        $this->assertTrue(Category::where('name', 'Panes')->exists());

    }

    public function test_can_view_category_details()
    {
        // Display the category details
        $response = $this->actingAs($this->user)->get('/categorias/' . $this->category->id);

        // Verify that the category details are displayed
        $response->assertStatus(200);
        $response->assertSee($this->category->id);
        $response->assertSee($this->category->name);
        $response->assertSee(Carbon::parse($this->category->created_at)->isoFormat('DD MMM YYYY'));
        $response->assertSee(Carbon::parse($this->category->updated_at)->isoFormat('DD MMM YYYY'));
    }

    public function test_a_category_can_be_deleted()
    {
        // Exceute the delete action in the live wire component
        Livewire::test(CategoriesLivewire\Delete::class)
            ->call('confirmDelete', $this->category->id)
            ->assertSet('delete_id', $this->category->id)
            ->assertSet('open', true)
            ->call('delete', $this->category->id)
            ->assertDispatched('render')
            ->assertDispatched('banner-message', style: 'success', message: 'Categoría eliminada correctamente');

        // Verify that the category was deleted from the database
        $this->assertFalse(Category::where('id', $this->category->id)->exists());
    }

}
