<?php

namespace App\Exports\Sales;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class Monthly implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    private $date_start;
    private $date_end;

    private $sales_data;

    public function __construct($date_start, $date_end, $sales_data)
    {
        $this->date_start = $date_start;
        $this->date_end = $date_end;
        $this->sales_data = $sales_data;
    }

    public function collection()
    {
        return $this->sales_data;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:E1');
        $sheet->getStyle('A1:E1')->getFont()->setSize(16);
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);
        $sheet->getStyle('A1:E1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('A2:E2');
        $sheet->getStyle('A2:E2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('3')->getFont()->setBold(true);

        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . $sheet->getHighestRow())
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);


        $sheet->getStyle('D')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('C')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('B')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('E')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
    }

    public function headings(): array
    {
        $date_start_formatted = date('d/m/Y', strtotime($this->date_start));
        $date_end_formatted = date('d/m/Y', strtotime($this->date_end));

        return [
            ['Reporte de Ventas Mensuales'],
            [
                "Desde: $date_start_formatted Hasta: $date_end_formatted"
            ],
            [
                'Mes',
                'Clientes',
                'Ventas Totales',
                'Monto Total',
                'Transacción Promedio',
            ]
        ];
    }

    public function map($sale): array
    {
        $date = $sale->month . '/' . $sale->year;
        $quantity = $sale->total_sales;
        $total = 'Bs ' . number_format($sale->total_amount, 1, ',', '.');
        $avarage_amount = 'Bs ' . number_format($sale->average_transaction, 1, ',', '.');
        $customers = $sale->unique_customers;

        return [
            $date,
            $customers,
            $quantity,
            $total,
            $avarage_amount,
        ];
    }
}
