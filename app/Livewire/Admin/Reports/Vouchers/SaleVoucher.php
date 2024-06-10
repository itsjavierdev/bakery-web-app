<?php

namespace App\Livewire\Admin\Reports\Vouchers;

use App\Models\Sale;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleVoucher extends Component
{
    public $sale_id;
    public $open = false;


    protected $listeners = ['generateSale', 'confirmGenerateSale'];

    public function render()
    {
        return view('livewire.admin.reports.vouchers.sale-voucher');
    }

    public function confirmGenerateSale($id)
    {
        $this->sale_id = $id;
        $this->open = true;
    }
    public function generateSale($id)
    {
        $sale = Sale::find($id);

        $pdf = PDF::loadView('exports.sale-voucher.sale-voucher', ['sale' => $sale])
            ->setPaper([0, 0, 204, 654], 'portrait')  // Establecer una longitud grande
            ->setOptions([
                'dpi' => 72,
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
                'isRemoteEnabled' => true,
            ]);


        $this->reset();

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, "Comprobante_Venta.pdf");

    }
}
