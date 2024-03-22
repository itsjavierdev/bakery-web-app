<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Staff;
use Spatie\Permission\Models\Role;

class UserManageTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $another_user;
    protected $role;

    protected function setUp(): void
    {
        parent::setUp();
        $this->role = Role::create(['name' => 'Administrador']);
        //Create example data
        $this->user = User::factory()->create()->assignRole($this->role);
        $this->another_user = User::factory()->create()->assignRole($this->role);
    }


    public function test_can_display_list_of_user(): void
    {
        // Display the list of user
        $response = $this->actingAs($this->user)->get('/personal');

        // Verify that the user are displayed
        $response->assertStatus(200);
        $response->assertSee($this->another_user->email);
        $response->assertSee($this->role->name);
    }
}
