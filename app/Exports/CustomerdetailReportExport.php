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

class CustomerdetailReportExport implements FromCollection, WithHeadings, WithMapping, WithEvents, WithCustomStartCell
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data['customer_data']);
    }

    public function headings(): array
    {
        return [
           'S.No',
            'Name',
            'Phone Number',
            'Email Address',
            'Gender',
            'Total Order',
            'Total Amount',
            
        ];
    }

    public function map($item): array
    {
        static $rowNumber = 0;
        $rowNumber++;
        // Transform gender and status fields
        $gender = $item->gender == 1 ? 'Male' : ($item->gender == 2 ? 'Female' : '');
       
        return [
            $rowNumber,  // Serial number
            ucfirst(strtolower($item->first_name)),
            $item->phone,
            $item->email,
            $gender,
            $item->total_orders? $item->total_orders:'0',
            $item->total_amount?$item->total_amount:'0',
            
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->mergeCells('A1:G2')->getStyle('A4:G4')
                    ->getFont()
                    ->setBold(true);
                $event->sheet->getStyle('A1')->getFont()->setBold(true)->setSize(20);
                $event->sheet->getStyle('A1')->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->setCellValue('A1', 'CUSTOMER-DETAIL REPORT');
            },
        ];
    }

    public function startCell(): string
    {
        return 'A4';
    }
}

