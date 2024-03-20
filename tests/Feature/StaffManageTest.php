<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use App\Livewire\Staff as StaffLivewire;
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
    public function test_a_role_can_be_created(): void
    {
        // Create the staff in live wire component
        Livewire::test(StaffLivewire\Create::class)
            ->set('name', 'Cristhian')
            ->set('surname', 'Justiniano')
            ->set('phone', '75525722')
            ->set('CI_number', '13315000')
            ->set('CI_extension', 'SC')
            ->set('birthdate', '1990-01-01')
            ->call('save')
            ->assertRedirect('personal')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Personal creado correctamente');

        // Verify that the staff was created in the database
        $this->assertTrue(Staff::where('name', 'Cristhian')->exists());
        $this->assertTrue(Staff::where('surname', 'Justiniano')->exists());
        $this->assertTrue(Staff::where('phone', '75525722')->exists());
        $this->assertTrue(Staff::where('CI', '13315000 SC')->exists());
        $this->assertTrue(Staff::where('birthdate', '1990-01-01')->exists());
    }


    public function test_can_display_list_of_staff(): void
    {
        // Display the list of staff
        $response = $this->actingAs($this->user)->get('/personal');

        // Verify that the staff are displayed
        $response->assertStatus(200);
        $response->assertSee('Javier');
        $response->assertSee('Vargas');
        $response->assertSee('12345678');
        $response->assertSee('12345678 SC');
    }
    public function test_a_staff_can_be_updated()
    {
        // Update the staff in live wire component
        Livewire::test(StaffLivewire\Update::class, ['staff' => $this->staff->id])
            ->set('name', 'Mario')
            ->set('surname', 'Vargas')
            ->set('phone', '75525723')
            ->set('CI_number', '13315002')
            ->set('CI_extension', 'LP')
            ->set('birthdate', '1990-01-12')
            ->call('update')
            ->assertRedirect('personal')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Personal actualizado correctamente');

        // Verify that the staff was updated in the database
        $this->assertTrue(Staff::where('name', 'Mario')->exists());
        $this->assertTrue(Staff::where('surname', 'Vargas')->exists());
        $this->assertTrue(Staff::where('phone', '75525723')->exists());
        $this->assertTrue(Staff::where('CI', '13315002 LP')->exists());
        $this->assertTrue(Staff::where('birthdate', '1990-01-12')->exists());
    }
}
