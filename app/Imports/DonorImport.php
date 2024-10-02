<?php

namespace App\Imports;

use App\Donor;
use App\Http\Controllers\DonorController;
use App\Model\Report;
use App\Rules\Transaction;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Carbon\Carbon;

class DonorImport implements ToCollection, SkipsOnFailure, WithStartRow
{

    use Importable ,SkipsFailures;

    private $errors = [];
    private $addedRows = 0;
    public function __construct()
    {

    }

    public function collection(Collection $rows)
    {
        $donorVtl = new DonorController();

        $rows = $rows->toArray();
        $i = 1 ;
        foreach ($rows as $key=>$row) {
            $validator = Validator::make($row, $this->rules($row), $this->validationMessages());
            if (!$validator->errors()->isEmpty()) {
                $ctr = 0;
                foreach ($validator->errors()->messages() as $messages) {
                    foreach ($messages as $error) {
                        $this->errors[$i][$ctr]['row'] = $i;
                        $this->errors[$i][$ctr]['error'] = $error;
                        $ctr++;
                  }
                }
            }else{
                    DB::beginTransaction();

                    $isExist = Report::where('repo_date', Carbon::parse($row[10])->format('Y-m-d'))->first();
                    if (!$isExist) {
                        $values = array('repo_date' => Carbon::parse($row[10])->format('Y-m-d'), 'payment_mode' => 'online');
                        $isExist = Report::create($values);
                    }

                    start:
                    $report_no = mt_rand(100000,999999);
                    $isExistDonor = DB::table('donors')->where('receipt_id', '=', $report_no)->orderBy('id', 'desc')->first();
                    if($isExistDonor){
                        goto start;
                    }


                    $donor  = new Donor();
                    $donor->report_id           = $isExist->id;
                    $donor->receipt_id          = $report_no;
                    $donor->payment_id          = (string)$row[8];
                    $donor->amount              = $row[7];
                    $donor->method              = $row[6];
                    $donor->status              = "Mail Sent";
                    $donor->donar_name          = $row[0];
                    $donor->donar_email         = $row[1];
                    $donor->donar_phone         = (string)$row[2];
                    $donor->donar_pan           = $row[5];
                    $donor->donar_dob           = ($row[3] != '')?''.Carbon::parse($row[3])->format('Y-m-d').'':'';
                    $donor->category            = $row[9];
                    $donor->productinfo         = "P1";
                    $donor->created_at          = Carbon::parse($row[10])->format('Y-m-d');
                    $donor->save();


                    $isExist->increment('count');
                    $isExist->save();

                    DB::commit();

                    if($donor){
                        $savedDonor = Donor::where('id', $donor->id)->first();
                        if($savedDonor){
                            if (filter_var($donor->donar_email, FILTER_VALIDATE_EMAIL)) {
                                $donorVtl->sendNewMail($donor->donar_email, $donor);
                            }
                        }
                    }
                    
                    $this->addedRows = $this->addedRows + 1;

            }
            $i++;
        }

    }


    public function startRow(): int
    {
        return 2;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getInsertedRows()
    {
       return $this->addedRows;
    }

    public function rules($row): array
    {
        return [
            '0' => ['required', 'regex:/^[a-zA-Z\s]+$/u'],
            '1' => ['required', 'email', 'regex:/^\S*$/u'],
            '2' => ['required', 'digits:10', ],
            '3' => ['nullable','date_format:d-m-Y'],
            '4' => ['nullable'],
            '5' => ['nullable'],
            '6' => ['required', 'string'],
            '7' => ['required', 'numeric', 'min:100'],
            '8' => ['required', new Transaction( (string)$row[8])],
            '9' => ['required'],
            '10' => ['required', 'date_format:d-m-Y', 'before_or_equal:now'],
        ];
    }


    public function validationMessages()
    {

       return [
            '0.required' => trans('Name is required'),
            '0.regex' => trans('Invalid name format'),
            '1.required' => trans('Email is required'),
		    '1.email'    => trans('Invalid Email'),
            '1.regex' => trans('Invalid Email format'),
            '2.required' => trans('Mobile is required'),
            '2.digits'   => trans('Minimum 10 digits for mobile number'),
            '3.date_format' => trans('Invalid date formate, required d-m-Y'),
            '6.required' => trans('Payment type required'),
            '6.string'   => trans('Payment type should be string'),
            '7.required' => trans('Amount is required'),
            '7.numeric'  => trans('Amount should numeric value'),
            '7.min'      => trans('Amount should greater than 100Rs'),
            '8.required' => trans('Transaction Id is required'),
            '9.required' => trans('Donation for is required'),
            '10.required'=> trans('Donation date is required'),
            '10.date_format' => trans('invalid donation date format'),
            '10.before_or_equal' => trans('Donation date not greater than today'),
        ];
    }

}

