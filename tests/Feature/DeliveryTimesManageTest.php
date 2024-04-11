<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use SebastianBergmann\Type\VoidType;
use Tests\TestCase;
use App\Models\DeliveryTime;
use Livewire\Livewire;
use App\Livewire\DeliveryTimes as DeliveryTimes;
use App\Models\User;
use Carbon\Carbon;

class DeliveryTimesManageTest extends TestCase
{
    use RefreshDatabase;

    protected $delivery_time;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->delivery_time = DeliveryTime::create([
            'time' => '10:00',
            'available' => true
        ]);
    }
    public function test_a_delivery_time_can_be_created(): void
    {
        // Create the delivery time in live wire component
        Livewire::test(DeliveryTimes\Create::class)
            ->set('time', '11:00')
            ->set('available', false)
            ->call('save')
            ->assertRedirect('horarios')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Horario creado correctamente');

        // Verify that the delivery time was created in the database
        $this->assertTrue(DeliveryTime::where('time', '11:00')->exists());
    }

    public function test_can_display_list_of_delivery_times(): void
    {
        // Display the list of delivery times
        $response = $this->actingAs($this->user)->get('/horarios');

        // Verify that the delivery times are displayed
        $response->assertStatus(200);
        $response->assertSee($this->delivery_time->time);
    }
    public function test_a_delivery_time_can_be_updated(): void
    {
        // Update the delivery time in live wire component
        Livewire::test(DeliveryTimes\Update::class, ['deliverytime' => $this->delivery_time->id])
            ->set('time', '11:00')
            ->set('available', false)
            ->call('update')
            ->assertRedirect('horarios')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Horario actualizado correctamente');

        // Verify that the delivery time was updated in the database
        $this->assertTrue(DeliveryTime::where('time', '11:00')->exists());
    }
    public function test_a_delivery_time_can_be_deleted(): void
    {
        // Delete the delivery time in live wire component
        Livewire::test(DeliveryTimes\Delete::class)
            ->call('confirmDelete', $this->delivery_time->id)
            ->assertSet('delete_id', $this->delivery_time->id)
            ->assertSet('open', true)
            ->call('delete', $this->delivery_time->id)
            ->assertDispatched('render')
            ->assertDispatched('banner-message', style: 'success', message: 'Horario eliminado correctamente');

        // Verify that the delivery time was deleted from the database
        $this->assertFalse(DeliveryTime::where('id', $this->delivery_time->id)->exists());
    }
}
