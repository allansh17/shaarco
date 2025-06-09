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

class CustomerReportExport implements FromCollection, WithHeadings, WithMapping, WithEvents, WithCustomStartCell
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data['order_data']);
    }

    public function headings(): array
    {
        return [
           'S.No',
           'Order Id',
           'Customer Name',
           'Order Date',
           'No Of Product',
           'Total Number Of Quantity',
           'Discount',
           'Shipping Charges',
           'Total Amount',
           'Order Status'
            
        ];
    }

    public function map($item): array
    {
        static $rowNumber = 0;
        $rowNumber++;
        // Transform gender and status fields
       
        return [
            $rowNumber,  // Serial number
            $item->id,
           ucwords(strtolower($item->first_name.' '.$item->last_name)),
            $item->created_at,
            $item->product_count,
            $item->total_quantity,
            $item->discount,
            $item->shipping_charges,
            $item->total_amount,
            $item->order_status == 0 ? 'Pending' : ($item->order_status == 1 ? 'Confirmed':($item->order_status == 2 ? 'Shipped':($item->order_status == 3 ? 'In Transit':($item->order_status == 4 ? 'Delivered':($item->order_status == 5 ? 'Cancelled':''))))),
             
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
                $event->sheet->setCellValue('A1', 'ORDER REPORT');
            },
        ];
    }

    public function startCell(): string
    {
        return 'A4';
    }
}

