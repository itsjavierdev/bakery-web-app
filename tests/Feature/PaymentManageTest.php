<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\Sale;
use App\Models\Staff;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use App\Livewire\Admin\Payments;

class PaymentManageTest extends TestCase
{
    use RefreshDatabase;
    protected $user;
    protected $payment;
    protected $sale;
    protected $customer;
    protected $staff;
    protected $sale_with_debt;
    protected $payment_partial;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->staff = Staff::factory()->create();

        $this->customer = Customer::create([
            'name' => 'Juan',
            'surname' => 'Perez',
            'phone' => '12345678',
            'email' => 'exmaple@test.com',
        ]);

        $this->sale = Sale::create([
            'total' => 100,
            'customer_id' => $this->customer->id,
            'staff_id' => $this->staff->id,
            'paid' => 1,
            'total_quantity' => 1,
            'paid_amount' => 100,
        ]);

        $this->payment = Payment::create([
            'sale_id' => $this->sale->id,
            'amount' => 100,
            'staff_id' => $this->staff->id,
            'customer_id' => $this->customer->id,
        ]);

        $this->sale_with_debt = Sale::create([
            'total' => 200,
            'customer_id' => $this->customer->id,
            'staff_id' => $this->staff->id,
            'paid' => 0,
            'total_quantity' => 1,
            'paid_amount' => 100,
        ]);
        $this->payment_partial = Payment::create([
            'sale_id' => $this->sale_with_debt->id,
            'amount' => 100,
            'staff_id' => $this->staff->id,
            'customer_id' => $this->customer->id,
        ]);
    }

    public function test_can_display_list_of_sales_with_debts(): void
    {
        // Display the list of sales with debts
        $response = $this->actingAs($this->user)->get('admin/pagos');

        // Check if the sale with debt is displayed
        $response->assertStatus(200);
        $response->assertSee($this->sale_with_debt->id);

        // Check if the sale without debt is not displayed
        $response->assertDontSee(' ' . $this->sale->id . ' ');
    }

    public function test_a_payment_can_be_added(): void
    {
        $this->actingAs($this->user);
        // Verify that the sale has debt
        $this->assertFalse($this->sale_with_debt->paid == 1);

        Livewire::test(Payments\Add::class, ['sale' => $this->sale_with_debt->id])
            ->set('paid_remaining', true)
            ->call('add')
            ->assertRedirect('admin/pagos')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Pago agregado correctamente.');

        // Verify that the sale was paid successfully
        $this->assertTrue(Sale::find($this->sale_with_debt->id)->paid == 1);
    }

    public function test_a_payments_can_be_updated(): void
    {
        $this->actingAs($this->user);
        // Verify that the sale has debt
        $this->assertFalse($this->sale_with_debt->paid == 1);

        Livewire::test(Payments\Update::class, ['sale' => $this->sale_with_debt])
            ->set('payments', [
                [
                    'id' => $this->payment_partial->id,
                    'staff_id' => $this->staff->id,
                    'staff_name' => $this->staff->name,
                    'staff_surname' => $this->staff->surname,
                    'amount' => 200,
                    'created_at' => $this->payment_partial->created_at,
                ],
            ])
            ->call('update')
            ->assertRedirect('admin/pagos')
            ->assertSessionHas('flash.bannerStyle', 'success')
            ->assertSessionHas('flash.banner', 'Pagos actualizado correctamente.');

        // Verify that the sale was paid successfully
        $this->assertTrue(Sale::find($this->sale_with_debt->id)->paid == 1);
    }

    public function test_can_view_payments_details(): void
    {
        // Display the payment details
        $response = $this->actingAs($this->user)->get('admin/pagos/' . $this->sale_with_debt->id);

        // Verify that the payment details are displayed
        $response->assertStatus(200);
        $response->assertSee($this->sale_with_debt->id);
        $response->assertSee($this->customer->name);
        $response->assertSee($this->customer->surname);
        $response->assertSee($this->sale_with_debt->total);
        $response->assertSee($this->staff->name);
        $response->assertSee($this->staff->surname);
        $response->assertSee($this->payment_partial->amount);
        $response->assertSee(Carbon::parse($this->payment_partial->created_at)->isoFormat('DD MMM YYYY'));
        ;
    }
}
