<?php

namespace App\Livewire\Admin\Dashboard\Products;

use Livewire\Component;
use App\Models\SaleDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LowRevenue extends Component
{
    public $less_revenue;

    public function render()
    {
        return view('livewire.admin.dashboard.products.low-revenue');
    }

    public function mount()
    {
        $this->less_revenue = SaleDetail::join('products', 'sale_details.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(sale_details.subtotal) as total_revenue'))
            ->whereBetween('sale_details.created_at', [Carbon::now()->subMonth(), Carbon::now()])
            ->groupBy('products.id', 'products.name')
            ->orderBy('total_revenue', 'asc')
            ->limit(10)
            ->get();
    }
}
