<?php

namespace App\Exports;

use App\Donor;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DonorsExport implements FromCollection, WithHeadings
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public $reportid;
    function __construct($id) {
            $this->reportid = $id;
    }

    public function collection()
    {
        $xys =  DB::table('donors')
                ->select( "created_at",'receipt_id',"donar_name", "donar_email","donar_phone", "donar_dob","donar_city","donar_pan",
                         "method", "amount","payment_id", "category", "pdf_status")
                ->where("report_id", $this->reportid)
                ->get();
        return $xys;
    }


    public function headings(): array
    {
        return ["Transaction Date", "Reciept No", "Donor Name", "Email", "Mobile Number", "DOB",
                    "City","PAN Number", "Payment Type", "Amount Paid", "Transaction Id", "Donation For", "Report Status" ];
    }
}
