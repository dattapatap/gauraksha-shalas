<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\DonationsListDataTable;
use App\Http\Controllers\Controller;

use App\DataTables\DonorListDataTable;
use App\Model\EmailSetting;
use Barryvdh\DomPDF\PDF;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DonorsExport;
use App\Exports\DonorWithDateRangeExport;
use App\Imports\DonorImport;
use App\Models\Donor;
use App\Models\EmailConfiguration;
use App\Models\Transaction;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Log;

class DonorController extends Controller
{

    public function index(DonorListDataTable $dataTable){
        return $dataTable->render('backend.donors.index');
    }

    public function donations(DonationsListDataTable $dataTable)
    {
        return $dataTable->render('backend.donations.index');
    }

    // fOR PAYMENT GETWAY
    public function createDonor(Request $request)
    {
        if (isset($request['payment_id'])) {
            try {
                DB::beginTransaction();

                $ispaidDonor = DB::table('donors')->where('payment_id', '=', $request['payment_id'])->first();
                if($ispaidDonor){
                    return response()->json(['success' => true, 'receipt_id' => $ispaidDonor->receipt_id], 200);
                    exit();
                }else{

                    start:
                    $report_no = mt_rand(10000000,99999900);
                    $isExistDonor = DB::table('donors')->where('receipt_no', '=', $report_no)->orderBy('id', 'desc')->first();
                    if($isExistDonor){
                        goto start;
                    }


                    $donor = new Donor();
                    $donor->receipt_no          = $report_no;
                    $donor->payment_id          = $request['payment_id'];
                    $donor->tax_id              = $request['tax_id'];
                    $donor->amount              = $request['amount'];
                    $donor->method              = $request['method'];
                    $donor->status              = $request['status'];
                    $donor->donar_name          = $request['donar_name'];
                    $donor->donar_email         = $request['donar_email'];
                    $donor->donar_phone         = $request['donar_phone'];
                    $donor->donar_dob           = $request['donar_dob'];
                    $donor->donar_city          = $request['donar_city'];
                    $donor->donar_pan           = $request['donar_pan'];
                    $donor->category            = $request['category'];
                    $donor->productinfo         = $request['productinfo'];
                    $donor->save();


                    $transaction = new Transaction();
                    $transaction->donor_id = $donor->id;
                    $transaction->payment_id = $request['payment_id'];;
                    $transaction->payment_order_id = "";
                    $transaction->payment_amount  = $request['amount'];
                    $transaction->payment_method = $request['method'];
                    $transaction->status = $request['status'];
                    $transaction->payment_date = Carbon::now();
                    $transaction->paymennt_info = $request['productinfo'];
                    $transaction->payment_name = $request['donar_name'];
                    $transaction->payment_email = $request['donar_email'];
                    $transaction->payment_mobile = $request['donar_phone'];
                    $transaction->save();

                    if (isset($request->donar_email)) {
                        $this->sendNewMail($request->donar_email, $donor);
                    }

                    DB::commit();

                    return response()->json(['success' => true, 'receipt_no' => $donor->receipt_no], 200);
                }
            } catch (Exception $ex) {
                DB::rollBack();
                return response()->json(['success' => false, 'message' => $ex->getMessage() . ' ON LINE-' . $ex->getLine()], 200);
            }
        } else {
            return response()->json(['success' => false, 'message' => "Donor not added"], 400);
        }
    }

    public function sendNewMail($address, $donor)
    {
        $getRecipient = EmailConfiguration::select('email_from', 'email_cc', 'email_bcc')->where('id', '1')->first();

        $data = [
            'name' => $donor->donar_name, 'pay_mode' =>$donor->method, 'phone_number' => $donor->donar_phone,
            'email_id' =>  $donor->donar_email, 'pan' =>  $donor->donar_pan, 'payment_date' =>  $donor->created_at, 'receipt_id' => $donor->receipt_no,
            'payment_id' =>  $donor->payment_id, 'amount' => $donor->amount, 'amount_in_words' => $this->convertNumberToWord( $donor->amount)
        ];
        $pdf = \PDF::loadView('backend.emailTemplates.email', $data);

        $pdfContent = $pdf->output();

        $values = array("pdf_status"=> "Mail is sent");
        Donor::Where('id', $donor->id)->update($values);

        $content = "Greetings from Gaurakshashalas !!! <br><br>
                    We are writing to express our deepest thanks for your recent donation to Gaurakshashalas. We truly appreciate your commitment to the help in our society.
                    <br><br>
                    Your donation has helped us to move a step forward to help the needy cows in our society saving their lives by providing medical facility and shelters.
                    <br><br>
                    Hence we thank you for your support provided and request your continuous support in the future.
                    <br><br>
                    Please find the 80G tax receipt attached.
                    <br><br>
                    Looking to help more kids through your contribution....
                    <br><br>Jayesh<br>
                    Trustee<br>9999999999<br>www.gaurakshashalas.org";

        $email = new \SendGrid\Mail\Mail();
        $email->setFrom( $getRecipient->email_from , 'Gaurakshashalas');
        $email->setSubject("80G Tax Receipt");
        $email->addTo($address);

         if ($getRecipient) {
            $cc = $getRecipient->email_cc;
            $bcc = $getRecipient->email_bcc;

            if ($bcc) {
                $email->addBCC($bcc);
            }
            if ($cc) {
                $email->addCC($cc);
            }
         }

        $email->addContent("text/html", $content);
        $email->addAttachment(
            base64_encode($pdfContent),
            "application/pdf",
            "Gaurakshashalas-80G-Tax-Receipt.pdf",
            "attachment"
        );
        $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));
        try {
            if ($sendgrid->send($email)) {
                return 'success';
            } else {
                Log::error('failed');
            }
        } catch (\Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }
    }


    public function editDonor(Request $request)
    {
        Log::info($request->id);
        $id = $request->donor_id;
        $donor = Donor::select('id', 'donar_email', 'donar_name', 'donar_dob', 'donar_phone', 'donar_pan',
                                'donar_city', 'amount', 'payment_id')
                            ->Where('id', $id)->first();

        return response()->json([ "status" =>true, "donor" => $donor], 200);
    }

    public function updateDonor(Request $request)
    {
        $rules = array(
            'editdonor_id' => ['required'],
            'editname' => ['required', 'string'],
            'editemail' => ['required', 'email'],
            'editmobile' => ['required', 'regex:/^([6-9]){1}([0-9]){9}/'],
            'editpan' => ['nullable', 'regex:/^([A-Z]){5}([0-9]){4}([A-Z]){1}/'],
            'editdate' => ['nullable', 'date'],
            'editcity' => ['nullable', 'string'],
            'edittransaction' => ['required', 'string'],
            'editamount' => ['required', 'numeric'],
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Response::json(array(
                'status' => 400,
                'errors' => $validator->getMessageBag()->toArray()
            ), 400);
        } else {
            if ($request->editdonor_id > 0) {

                DB::beginTransaction();
                try {
                    $donor  = Donor::where('id', $request->editdonor_id)->first();

                    $donor->donar_name          = $request['editname'];
                    $donor->donar_email         = $request['editemail'];
                    $donor->donar_phone         = $request['editmobile'];
                    $donor->donar_pan           = $request['editpan'];
                    $donor->donar_dob           = $request['editdate'];
                    $donor->donar_city          = $request['editcity'];
                    $donor->payment_id          = $request['edittransaction'];
                    $donor->amount              = $request['editamount'];
                    $donor->save();

                    DB::commit();
                    return response()->json(['status' => true, 'message' => 'Donor updated successfully'], 200);
                } catch (Exception $ex) {
                    DB::rollBack();
                    return response()->json(['status' => false, 'message' => "Donor not updated, please try again!"], 200);
                }
            }
        }
    }

    public function viewDonor(Request $request)
    {
        $donor = Donor::where('id', $request->id)->first();
        if (!$donor) {
            abort(404, 'Donor not found');
        }
        return view('backend.donations.donorview', compact('donor'));
    }

    public function downloadReceipt(Request $request)
    {
        $receipt_no = $request->receipt_no;
        $donor = Donor::Where('receipt_no', $receipt_no)->first();

        if($donor){

            $data = [
                'name' => $donor->donar_name, 'pay_mode' => $donor->method, 'phone_number' => $donor->donar_phone,
                'email_id' => $donor->donar_email, 'pan' => $donor->donar_pan, 'payment_date' => $donor->created_at, 'receipt_id' => $donor->receipt_no,
                'payment_id' => $donor->payment_id, 'amount' => $donor->amount, 'amount_in_words' => $this->convertNumberToWord($donor->amount)
            ];

            $pdf = \PDF::loadView('backend.emailTemplates.email', $data);
            return $pdf->download('receipt_' . $donor->receipt_no . '.pdf');
        }

    }




    public function sendMail(Request $request)
    {
        set_time_limit(300);
        $id = $request['id'];
        $emails = Donor::select('id', 'receipt_no', 'donar_email', 'donar_name', 'created_at', 'amount', 'donar_phone', 'donar_pan',
                     'payment_id', 'method')->whereIn('id', $id)->get();

        $getRecipient = EmailConfiguration::select('email_from', 'email_cc', 'email_bcc')->where('id', '1')->first();

        foreach ($emails as $data) {
            $pdf = \PDF::loadView('backend.emailTemplates.email', [
                'name' => $data->donar_name,
                'pay_mode' => $data->method,
                'phone_number' => $data->donar_phone,
                'pan' => $data->donar_pan,
                'email_id' => $data->donar_email,
                'payment_date' => $data->created_at,
                'receipt_id' => $data->receipt_no,
                'payment_id' => $data->payment_id,
                'amount' => $data->amount,
                'amount_in_words' => $this->convertNumberToWord($data->amount),
            ]);
            $pdfContent = $pdf->output();
            // Send the email with PDF content as an attachment
            $status = $this->sendReportMail($getRecipient, $data->donar_email, $pdfContent, 'receipt_' . $data->receipt_no . '.pdf');

            if ($status == 'success') {
                $values = ['pdf_status' => 'Mail is sent'];
                Donor::where('id', $data->id)->update($values);
            }
        }
        return response()->json(['status'=> true, "Message" => "Mails has been sent successfully, Please check Once!" ]);
    }

    public function sendReportMail($getRecipient, $address, $pdfContent, $fileName)
    {
        $content = "Greetings from Gaurakshashalas !!! <br><br>
                    We are writing to express our deepest thanks for your recent donation to Gaurakshashalas. We truly appreciate your commitment to the help in our society.
                    <br><br>
                    Your donation has helped us to move a step forward to help the needy cows in our society saving their lives by providing medical facility and shelters.
                    <br><br>
                    Hence we thank you for your support provided and request your continuous support in the future.
                    <br><br>
                    Please find the 80G tax receipt attached.
                    <br><br>
                    Looking to help more kids through your contribution....
                    <br><br>Jayesh<br>
                    Trustee<br>9999999999<br>www.gaurakshashalas.org";

        $email = new \SendGrid\Mail\Mail();
        $email->setFrom( $getRecipient->email_from , 'Gaurakshashalas');
        $email->setSubject("80G Tax Receipt");
        $email->addTo($address);

         if ($getRecipient) {
            $cc = $getRecipient->email_cc;
            $bcc = $getRecipient->email_bcc;

            if ($bcc) {
                $email->addBCC($bcc);
            }
            if ($cc) {
                $email->addCC($cc);
            }
         }

        $email->addContent("text/html", $content);
        $email->addAttachment(
            base64_encode($pdfContent),
            "application/pdf",
             $fileName,
            "attachment"
        );
        $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));
        try {
            if ($sendgrid->send($email)) {
                return 'success';
            } else {
                Log::error('failed');
            }
        } catch (\Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }



    }



    function convertNumberToWord($number)
    {
        $no = floor($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array(
            '0' => '', '1' => 'One', '2' => 'Two',
            '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
            '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
            '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
            '13' => 'Thirteen', '14' => 'Fourteen',
            '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
            '18' => 'Eighteen', '19' => 'Nineteen', '20' => 'Twenty',
            '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
            '60' => 'Sixty', '70' => 'Seventy',
            '80' => 'Eighty', '90' => 'Ninety'
        );
        $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
        while ($i < $digits_1) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += ($divider == 10) ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? '' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str[] = ($number < 21) ? $words[$number] .
                    " " . $digits[$counter] . $plural . " " . $hundred
                    :
                    $words[floor($number / 10) * 10]
                    . " " . $words[$number % 10] . " "
                    . $digits[$counter] . $plural . " " . $hundred;
            } else $str[] = null;
        }
        $str = array_reverse($str);
        $result = implode('', $str);
        $points = ($point) ?
            ", " . $words[floor($point / 10) * 10] . " " .
            $words[$point = $point % 10] : '';

        if ($points == '') {
            return $result . "Rupees";
        } else {
            return $result . "Rupees" . $points . " Paise";
        }
    }

    function validateDate($myDateString){
        if (DateTime::createFromFormat('d/m/Y', $myDateString) !== false) {
            return true;
        }else{
            return false;
        }
    }

}

