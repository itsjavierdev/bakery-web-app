<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Payment;
use App\Models\Sale;
use Livewire\Component;
use App\Models\Order;

class Summary extends Component
{
    //Orders 
    public $totalOrders;
    //Incomes
    public $totalIncomeToday;
    public $totalIncomeYesterday;
    //Products sales
    public $totalProductsSoldToday;
    public $totalProductsSoldYesterday;
    //Sales
    public $totalSalesToday;
    public $totalSalesYesterday;
    //Customers
    public $totalCustomers;

    public function render()
    {
        return view('livewire.admin.dashboard.summary');
    }
    public function mount()
    {
        //Orders 
        $this->totalOrders = Order::count();

        //Incomes
        $this->totalIncomeToday = Payment::whereDate('created_at', today())->sum('amount');
        $this->totalIncomeYesterday = Payment::whereDate('created_at', today()->subDay())->sum('amount');

        //Products sales
        $this->totalProductsSoldToday = Sale::whereDate('created_at', today())->sum('total_quantity');
        $this->totalProductsSoldYesterday = Sale::whereDate('created_at', today()->subDay())->sum('total_quantity');

        //Sales
        $this->totalSalesToday = Sale::whereDate('created_at', today())->count();
        $this->totalSalesYesterday = Sale::whereDate('created_at', today()->subDay())->count();

        //Customers
        $this->totalCustomers = Sale::distinct('customer_id')->count();


    }
}
