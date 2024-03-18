<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Staff;
use Tests\TestCase;

class StaffManageTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $staff;

    protected function setUp(): void
    {
        parent::setUp();

        //Create example data
        $this->user = User::factory()->create();
        $this->staff = Staff::create([
            'name' => 'Javier',
            'surname' => 'Vargas',
            'phone' => '12345678',
            'CI' => '12345678 SC',
            'birthdate' => '1990-01-01',
        ]);
    }
    public function test_can_display_list_of_staff(): void
    {
        // Display the list of roles
        $response = $this->actingAs($this->user)->get('/staff');

        // Verify that the roles are displayed
        $response->assertStatus(200);
        $response->assertSee('Javier');
        $response->assertSee('Vargas');
        $response->assertSee('12345678');
        $response->assertSee('12345678 SC');
    }
}
