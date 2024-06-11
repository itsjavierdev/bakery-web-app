<?php

namespace App\Livewire\Admin\Reports\Vouchers;

use App\Models\Payment;
use App\Models\Sale;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;

class AllPaymentsVoucher extends Component
{
    public $sale_id;
    public $open_modal = false;


    protected $listeners = ['generatePayments', 'confirmGenerateSale'];
    public function render()
    {
        return view('livewire.admin.reports.vouchers.all-payments-voucher');
    }

    public function confirmGenerateSale($id)
    {
        $this->sale_id = $id;
        $this->open_modal = true;
    }
    public function generatePayments($id)
    {
        $sale = Sale::find($id);
        $customer = $sale->customer->name . ' ' . $sale->customer->surname;

        $pdf = PDF::loadView('exports.payment-voucher.all', ['sale' => $sale])
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
        }, "Comprobante_Pagos_{$customer}_Venta_N_{$sale->id}.pdf");

    }
}
