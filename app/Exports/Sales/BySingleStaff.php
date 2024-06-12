<?php

namespace App\Exports\Sales;

use App\Models\Staff;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class BySingleStaff implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    private $date_start;
    private $date_end;

    private $sales_data;

    private $staff;

    public function __construct($date_start, $date_end, $sales_data, $staff)
    {
        $this->date_start = $date_start;
        $this->date_end = $date_end;
        $this->sales_data = $sales_data;
        $this->staff = Staff::where('id', $staff)->first();
    }

    public function collection()
    {
        return $this->sales_data;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:D1');
        $sheet->getStyle('A1:D1')->getFont()->setSize(16);
        $sheet->getStyle('A1:D1')->getFont()->setBold(true);
        $sheet->getStyle('A1:D1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('A2:D2');
        $sheet->getStyle('A2:D2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('3')->getFont()->setBold(true);

        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . $sheet->getHighestRow())
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);


        $sheet->getStyle('D')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
    }

    public function headings(): array
    {
        $date_start_formatted = date('d/m/Y', strtotime($this->date_start));
        $date_end_formatted = date('d/m/Y', strtotime($this->date_end));

        return [
            ["Ventas de {$this->staff->name} {$this->staff->surname}"],
            [
                "Desde: $date_start_formatted Hasta: $date_end_formatted"
            ],
            [
                'ID',
                'Fecha',
                'Cliente',
                'Monto',
            ]
        ];
    }

    public function map($sale): array
    {
        $date = date('d/m/Y', strtotime($sale->created_at));
        $customer = $sale->customer->name . ' ' . $sale->customer->surname;
        $total = 'Bs ' . $sale->total;

        return [
            $sale->id,
            $date,
            $customer,
            $total,
        ];
    }
}
