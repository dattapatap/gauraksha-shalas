<?php

namespace App\Exports;

use App\Models\Requests;
use App\Models\User;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Customers extends DefaultValueBinder implements FromCollection, WithHeadings , ShouldAutoSize, WithCustomValueBinder
{


    public $request;
    function __construct($request) {
            $this->request = $request;
    }

    public function collection()
    {

        $users  = User::select('id', 'name', 'rolecode', 'email','mobile' , 'gender', 'state', 'city', 'status', 'created_at' );

        if ($this->request->range =='custom' &&  $this->request->reportrange) {
            $range = explode(' - ', $this->request->reportrange);
            $users->whereDate('created_at', '>=',  Carbon::createFromFormat('d/m/Y', $range[0])->startOfDay()->format('Y-m-d'));
            $users->whereDate('created_at', '<=',  Carbon::createFromFormat('d/m/Y', $range[1])->endOfDay()->format('Y-m-d'));
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

            $users->whereDate('created_at', '>=', $date_start );
            $users->whereDate('created_at', '<=', $date_end );;
        }

        if ( $this->request->search) {
            $val =  $this->request->search;
            $users->Where('created_at', 'LIKE', "%$val%");
            $users->orWhere('name', 'LIKE', "%$val%");
            $users->orWhere('mobile', 'LIKE', "%$val%");
            $users->orWhere('email', 'LIKE', "%$val%");
            $users->orWhere('state', 'LIKE', "%$val%");
            $users->orWhere('city', 'LIKE', "%$val%");
            $users->orWhere('status', 'LIKE', "%$val%");
            $users->orWhere('gender', 'LIKE', "%$val%");
        }
        $datas = $users->get();

        foreach($datas as $key=>$row){
            $row->id = $key + 1;
            $row->status = ($row->status == true)?'ACTIVE':"INACTIVE";
            $row->created_at = date("d-m-Y", strtotime($row->created_at));
        }
        return $datas;
    }


    public function headings(): array
    {
        return ["Sr. No.", "Customer", " Role ", "Email", "Mobile", "Gender", "State", "City", "Status", "Register Date" ];
    }

    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_TEXT,
            'J' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function bindValue(Cell $cell, $value){
        if ($cell->getColumn() == 'J') {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);
            return true;
        }
        return parent::bindValue($cell, $value);
    }

}
