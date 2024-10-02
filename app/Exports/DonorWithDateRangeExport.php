<?php

namespace App\Exports;

use App\Donor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DonorWithDateRangeExport implements FromCollection, WithHeadings
{

    public $from, $to;
    function __construct($from , $to) {
            $this->from = $from;
            $this->to = $to;
    }

    public function collection()
    {
        return  DB::table('donors as d')
                ->join('tbl_report as r', 'r.id', '=', 'd.report_id')
                ->select( "r.repo_date",'d.receipt_id',"d.donar_name", "d.donar_email","d.donar_phone", "d.donar_dob","d.donar_city","d.donar_pan",
                         "d.method", "d.amount","d.payment_id", "d.category", "d.pdf_status",)
                ->whereBetween("r.repo_date",[ Carbon::createFromFormat('d/m/Y', $this->from)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $this->to)->format('Y-m-d')])
                ->get();
    }


    public function headings(): array
    {
        return ["Transaction Date", "Reciept No", "Donor Name", "Email", "Mobile Number", "DOB",
                    "City","PAN Number", "Payment Type", "Amount Paid", "Transaction Id", "Donation For", "Report Status", ];
    }
}
