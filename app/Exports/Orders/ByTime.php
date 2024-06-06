<?php

namespace App\Exports\Orders;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ByTime implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    private $date_start;
    private $date_end;

    private $data;

    public function __construct($date_start, $date_end, $data)
    {
        $this->date_start = $date_start;
        $this->date_end = $date_end;
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
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

        $sheet->getStyle('B')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('C')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('D')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
    }

    public function headings(): array
    {
        $date_start_formatted = date('d/m/Y', strtotime($this->date_start));
        $date_end_formatted = date('d/m/Y', strtotime($this->date_end));

        return [
            ['Horarios mas solicitados'],
            [
                "Desde: $date_start_formatted Hasta: $date_end_formatted"
            ],
            [
                'Hora',
                'Pedidos',
                'Recogida en tienda',
                'Envio a domicilio',
            ]
        ];
    }

    public function map($data): array
    {
        return [
            $data->time,
            $data->total_orders,
            $data->address_orders,
            $data->no_address_orders,
        ];
    }
}
