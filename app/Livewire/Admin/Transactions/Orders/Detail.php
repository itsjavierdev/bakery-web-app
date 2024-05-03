<?php

namespace App\Livewire\Admin\Transactions\Orders;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderDetail;

class Detail extends Component
{
    public $order;
    public $products;
    public $order_detail;
    public $debt;
    public $actions = [
        'delivery',
        'update',
        'delete'
    ];

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->products = $order->products;
        $this->order_detail = OrderDetail::where('order_id', $order->id)->get();
        $this->debt = "$order->total $order->paid_amount";
    }

    public function render()
    {
        return view('livewire.admin.transactions.orders.detail')->layout('layouts.admin-header', ['title' => 'Detalle de pedido', 'titleAlign' => 'center']);
    }
}
