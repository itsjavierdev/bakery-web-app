<?php

namespace App\Livewire\Admin\Reports\Vouchers;

use App\Models\Payment;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentVoucher extends Component
{
    public $payment_id;
    public $open = false;


    protected $listeners = ['generatePayment', 'confirmGeneratePayment'];

    public function render()
    {
        return view('livewire.admin.reports.vouchers.payment-voucher');
    }

    public function confirmGeneratePayment($id)
    {
        $this->payment_id = $id;
        $this->open = true;
    }
    public function generatePayment($id)
    {
        $payment = Payment::find($id);
        $pdf = PDF::loadView('exports.payment-voucher.single', ['payment' => $payment])
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
        }, "Comprobante_Pago.pdf");

    }
}
