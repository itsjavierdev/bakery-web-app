<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\Sale;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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
}
