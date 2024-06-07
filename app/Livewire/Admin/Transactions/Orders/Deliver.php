<?php

namespace App\Livewire\Admin\Transactions\Orders;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Sale;
use Livewire\Component;
use Livewire\Attributes\On;
use Laravel\Jetstream\InteractsWithBanner;


class Deliver extends Component
{
    use InteractsWithBanner;
    public $open = false;
    public $order;
    public $products;
    public $order_details;
    public $debt;

    //inputs
    public $new_paid;
    public $paid_all;

    public function render()
    {
        return view('livewire.admin.transactions.orders.deliver');
    }

    public function rules()
    {
        $rules = [];
        $rules['new_paid'] = [
            'nullable',
            'numeric',
            'between:0,99999.9',
            function ($attribute, $value, $fail) {
                if ($value + $this->order->paid_amount > ($this->order->total + 1)) {
                    $fail('El monto pagado no puede ser mayor que el monto restante');
                }
            },
        ];

        return $rules;
    }

    public function deliver()
    {
        $this->validate();

        $paid_amount = $this->order->paid_amount + $this->new_paid;

        $sale = Sale::create([
            'total' => $this->order->total,
            'paid' => $paid_amount == $this->order->total ? true : false,
            'paid_amount' => $paid_amount,
            'total_quantity' => $this->order->total_quantity,
            'staff_id' => auth()->user()->staff->id,
            'customer_id' => $this->order->customer_id,
        ]);

        foreach ($this->order_details as $order_detail) {
            $sale->products()->attach($order_detail->product_id, [
                'product_price' => $order_detail->product_price,
                'quantity' => $order_detail->quantity,
                'subtotal' => $order_detail->subtotal,
                'by_bag' => $order_detail->by_bag,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->order->update([
            'delivered' => true,
        ]);

        if ($paid_amount == 0) {
            Payment::create([
                'sale_id' => $sale->id,
                'amount' => $this->order->paid_amount,
                'customer_id' => $this->order->customer_id,
                'staff_id' => $this->order->staff_id,
            ]);
        }

        Payment::create([
            'sale_id' => $sale->id,
            'amount' => $this->new_paid,
            'customer_id' => $this->order->customer_id,
            'staff_id' => auth()->user()->staff->id,
        ]);
        $this->dispatch('render')->to(Read::class);

        $this->reset();
        $this->banner('Pedido entregado correctamente');

    }

    #[On('delivery')]
    public function delivery($id)
    {
        $this->open = true;
        $this->order = Order::find($id);

        $this->products = $this->order->products;
        $this->order_details = OrderDetail::where('order_id', $id)->get();

        $this->debt = $this->order->total - $this->order->paid_amount;
    }

    public function updatedPaidAll()
    {
        $this->new_paid = round($this->order->total - $this->order->paid_amount, 2);
    }
}
