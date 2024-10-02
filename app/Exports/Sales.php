<?php

namespace App\Exports;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Sales extends DefaultValueBinder implements FromCollection, WithHeadings , ShouldAutoSize, WithCustomValueBinder
{


    public $request;
    function __construct($request) {
            $this->request = $request;
    }

    public function collection()
    {

        $orders  = Order::select('orders.id', 'orders.order_id', 'orders.invoice_no', 'tr.payment_id', 'orders.created_at',  'orders.status', 'orders.order_cost' , 'orders.shipping_cost',
                                 'orders.subtotal', 'ur.name', 'orders.city', 'orders.address', 'orders.pincode', 'orders.shipment_id', 'orders.ship_order_id', 'orders.delivered_dt' )
                                ->join('transactions as tr', 'tr.id', '=', 'orders.transaction_id')
                                ->join('users as ur', 'ur.id', '=', 'orders.user_id')
                                ->whereNotIn('orders.status', ['Cancelled', 'Initiated']);

        if ($this->request->range =='custom' &&  $this->request->reportrange) {
            $range = explode(' - ', $this->request->reportrange);
            $orders->whereDate('orders.created_at', '>=',  Carbon::createFromFormat('d/m/Y', $range[0])->startOfDay()->format('Y-m-d'));
            $orders->whereDate('orders.created_at', '<=',  Carbon::createFromFormat('d/m/Y', $range[1])->endOfDay()->format('Y-m-d'));
        }else{
            if($this->request->range == 'current_month'){
                $date_start = Carbon::now()->startOfMonth();
                $date_end = Carbon::now()->endOfMonth();
            }elseif($this->request->range == 'last_month'){
                $date_start = Carbon::now()->startOfMonth()->subMonthsNoOverflow();
                $date_end = Carbon::now()->subMonthsNoOverflow()->endOfMonth();
            }elseif($this->request->range == 'year'){
                $date_start = Carbon::now()->startOfYear();
                $date_end = Carbon::now()->endOfYear();
            }else{
                $date_start = date('Y-m-d 00:00:00');
                $date_end = date('Y-m-d 23:59:59');
            }

            $orders->whereDate('orders.created_at', '>=', $date_start );
            $orders->whereDate('orders.created_at', '<=', $date_end );;
        }

        if ( $this->request->search) {
            $val =  $this->request->search;
            $orders->Where('orders.created_at', 'LIKE', "%$val%");
            $orders->orWhere('orders.order_id', 'LIKE', "%$val%");
            $orders->orWhere('orders.invoice_no', 'LIKE', "%$val%");
            $orders->orWhere('orders.subtotal', 'LIKE', "%$val%");
            $orders->orWhere('orders.shipping_cost', 'LIKE', "%$val%");
            $orders->orWhere('orders.status', 'LIKE', "%$val%");
        }
        $datas = $orders->get();

        foreach($datas as $key=>$row){
            $row->id = $key + 1;
        }
        return $datas;
    }


    public function map($row): array
    {
        return [
            $row->created_at = \Carbon\Carbon::createFromFormat('d/m/Y', $row->created_at)->format('Y-m-d'),
        ];
    }

    public function headings(): array
    {
        return ["Sr. No.", "Order id", "Invoice No", "Transaction Reference",  "Order Date", "Order Status", "Order Cost", "Shipping Charges",
                    "Total Amount", "Customer ", "City", "Shipping Address", "Pincode", "Shipment Order Id", "Shipment Tracking Id", "Delivered Date"];
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_NUMERIC);

            return true;
        }
        return parent::bindValue($cell, $value);
    }


}
