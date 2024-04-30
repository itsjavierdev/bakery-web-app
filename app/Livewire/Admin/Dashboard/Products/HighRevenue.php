<?php

namespace App\Livewire\Admin\Dashboard\Products;

use Livewire\Component;
use App\Models\SaleDetail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HighRevenue extends Component
{
    public $high_revenue;

    public function render()
    {
        return view('livewire.admin.dashboard.products.high-revenue');
    }

    public function mount()
    {
        $this->high_revenue = SaleDetail::join('products', 'sale_details.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(sale_details.subtotal) as total_revenue'))
            ->whereBetween('sale_details.created_at', [Carbon::now()->subMonth(), Carbon::now()])
            ->groupBy('products.id', 'products.name')
            ->orderBy('total_revenue', 'desc')
            ->limit(10)
            ->get();
    }
}
