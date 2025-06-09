<?php




// app/Exports/CustomerReportExport.php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class ProductReportExport implements FromCollection, WithHeadings, WithMapping, WithEvents, WithCustomStartCell
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data['product_data']);
    }

    public function headings(): array
    {
        return [
           'S.No',
            'Product Name',
            'Available QTY',
            'STotal sale QTY',
            'Total sale amount',
            'Total Reviews',
            'Average Rating',
            'Price',
        ];
    }

    public function map($item): array
    {
        static $rowNumber = 0;
        $rowNumber++;
        return [
            $rowNumber,  // Serial number
            ucfirst(strtolower($item->ProductName)), 
            $item->AvailableQuantity?$item->AvailableQuantity:'0',
           
            $item->TotalSaleQuantity,
            $item->TotalSaleAmount,
            $item->totalreviews? $item->totalreviews:'0',
            $item->AverageRating? $item->AverageRating:'0',
            $item->ProductPrice,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->mergeCells('A1:I2')->getStyle('A4:I4')
                    ->getFont()
                    ->setBold(true);
                $event->sheet->getStyle('A1')->getFont()->setBold(true)->setSize(20);
                $event->sheet->getStyle('A1')->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->setCellValue('A1', 'PRODUCT REPORT');
            },
        ];
    }

    public function startCell(): string
    {
        return 'A4';
    }
}

