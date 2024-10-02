<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Donor;
use App\Models\EmailConfiguration;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Razorpay\Api\Errors\SignatureVerificationError;

class PaymentController extends Controller
{



    public function initilisePayment(Request $request){

        $rules = array(
            'amount' => ['required', 'numeric', 'min:100'],
            'full_name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'regex:/^([6-9]){1}([0-9]){9}/'],
            'pan' => ['nullable', 'regex:/^([A-Z]){5}([0-9]){4}([A-Z]){1}/'],
            'date' => ['nullable', 'date'],
            'city' => ['required', 'string'],
            'category' => ['required', 'string'],
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array( 'errors' => $validator->getMessageBag()->toArray() ), 400);
        }

        $totalAmount = (float)$request->amount;

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $orderData  = $api->order->create([
            'receipt' => strval(rand(10000000, 99999999)),
            'amount' =>  $totalAmount * 100,
            'currency' => 'INR',
        ]);

        $data = [
            "key"                   => env('RAZORPAY_KEY'),
            "amount"                => $totalAmount * 100,
            "order_id"              => $orderData['id'],
            "name"                  => $request->full_name,
            "phone"                 => $request->phone,
            "email"                 => $request->email,
            "notes"                 => array( "pan"=> $request->pan,  "city" => $request->city,
                                            "dob" => $request->date, "category"=> $request->category,
                                             "name"=>$request->full_name)

        ];

        return response()->json(['status'=>true, 'data'=> $data] ,200);

    }


    public function paymentResponse(Request $request){

        $success = false;
        if ( !empty( $request->razorpay_payment_id ) ) {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            try {

                $attributes = [
                    'razorpay_order_id' => $request->razorpay_order_id,
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature
                ];
                $api->utility->verifyPaymentSignature($attributes);
                $success = true;

            } catch (SignatureVerificationError $e) {
                $success = false;
                $error = 'Razorpay Error : ' . $e->getMessage();
            }
        }

        if ($success == true) {

            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $payment = $api->payment->fetch($request->razorpay_payment_id);

            try {
                DB::beginTransaction();

                $ispaidDonor = DB::table('donors')->where('payment_id', '=', $payment['id'])->first();
                if($ispaidDonor){
                    return response()->json(['status' => true, 'receipt_no' => $ispaidDonor->receipt_no], 200);
                }else{

                    start:
                    $report_no = mt_rand(10000000,99999999);
                    $isExistDonor = DB::table('donors')->where('receipt_no', '=', $report_no)->orderBy('id', 'desc')->first();
                    if($isExistDonor){
                        goto start;
                    }


                    $donor = new Donor();
                    $donor->receipt_no          = $report_no;
                    $donor->payment_id          = $payment['id'];
                    $donor->amount              = ($payment['amount'] / 100 );
                    $donor->method              = $payment['method'];
                    $donor->status              = $payment['status'];

                    $donor->donar_name          = $payment->notes['name'];
                    $donor->donar_email         = $payment['email'];
                    $donor->donar_phone         = $payment['contact'];

                    $donor->donar_dob           = isset($payment->notes['dob'])?$payment->notes['dob']:'';
                    $donor->donar_city          = isset($payment->notes['city'])?$payment->notes['city']:'';
                    $donor->donar_pan           = isset($payment->notes['pan'])?$payment->notes['pan']:'';
                    $donor->category            = $payment->notes['category'];
                    $donor->productinfo         = "p1";
                    $donor->save();


                    $transaction = new Transaction();
                    $transaction->donor_id = $donor->id;
                    $transaction->payment_id = $payment['id'];
                    $transaction->payment_order_id = $payment["order_id"];
                    $transaction->payment_amount  = $payment['amount'];
                    $transaction->payment_method = $payment['method'];
                    $transaction->status = $payment['status'];
                    $transaction->payment_date = Carbon::now();
                    $transaction->payment_info = json_encode($payment);
                    $transaction->payment_name =  $donor->donar_name;
                    $transaction->payment_email =  $donor->donar_email;
                    $transaction->payment_mobile =  $donor->donar_phone;
                    $transaction->save();

                    if (isset($donor->donar_email)) {
                        $this->sendNewMail($donor->donar_email, $donor);
                    }

                    DB::commit();
                    return response()->json(['status' => true, 'receipt_no' => $donor->receipt_no], 200);

                }
            } catch (Exception $ex) {
                DB::rollBack();
                return response()->json(['status' => false, 'message' => $ex->getMessage() . ' ON LINE-' . $ex->getLine()], 200);
            }
        }else{
            return response()->json(['status'=>true, 'message'=>'Your payment has been failed, Please try again!']);
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
                Log::error('success');
            } else {
                Log::error('failed');
            }
        } catch (\Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }
    }


    public function checkPaymentStatus(){

        $date = new DateTime();
        $date->modify('-10 minutes');
        $order_date = $date->format('Y-m-d H:i:s');

        $orders = Order::with('transaction')->where('payment_status', 'Initiated')
                        ->where('created_at', '<=', $order_date)->get();


        foreach($orders as  $order) {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $payment = $api->order->fetch($order->transaction->payment_order_id)->payments();
            if( $payment && $payment->count > 0){
                $totPayment = $payment->count;
                $currPayObject = $payment->items[$totPayment-1];


                if($currPayObject &&  $currPayObject['status'] == 'captured') {

                    $transaction = Transaction::where('payment_order_id', $currPayObject['order_id'] )->first();
                    if($transaction){

                        $user = User::where('id', $transaction->user_id)->first();

                        $transaction->payment_id          = $currPayObject['id'];
                        $transaction->status              = $currPayObject['status'];
                        $transaction->payment_method      = $currPayObject['method'];

                        $transaction->payment_name        = $user->name;
                        $transaction->payment_email       = $currPayObject['email'];
                        $transaction->payment_mobile      = $currPayObject['contact'];

                        $transaction->save();

                        $order = Order::where('transaction_id', $transaction->id)->first();
                        $order->payment_type            = "online";
                        $order->payment_status          = $currPayObject['status'];
                        $order->status                  = "Pending";
                        $order->save();

                        $history = new OrderHistory();
                        $history->order_id = $order->id;
                        $history->date = Carbon::now();
                        $history->status = 'Placed';
                        $history->save();

                        $user->notify((new OrderPlaced($order))->delay(now()->addSeconds(20)));

                        $admin = Admin::find(1);
                        $admin->notify((new OrderPlacedAdmin($order, $user))->delay(now()->addSeconds(10)));


                        if($order->coupon > 0 ){
                            DB::table('coupons')->where('id', $order->coupon )->increment('total_used', 1);
                            $usages = DB::table('user_coupons')->where('user_id', $user->id )->where('coupon_id', $order->coupon )->first();
                            if($usages){
                                DB::table('user_coupons')->where('id', $usages->id)->increment('usage_count', 1);
                            }else{
                                DB::insert('insert into user_coupons (user_id , coupon_id , usage_count)
                                values (?, ?, ?)', [$user->id ,  $order->coupon , 1  ]);
                            }
                        }

                    }

                }else{
                    $transaction = Transaction::where('payment_order_id', $currPayObject['order_id'] )->first();
                    if($transaction){

                        $transaction->payment_id          = $currPayObject['id'];
                        $transaction->status              = $currPayObject['status'];
                        $transaction->payment_method      = $currPayObject['method'];

                        $transaction->save();

                        $order = Order::where('transaction_id', $transaction->id)->first();
                        $order->payment_type            = "online";
                        $order->payment_status          = $currPayObject['status'];
                        $order->status                  = "Cancelled";
                        $order->save();

                        $history = new OrderHistory();
                        $history->order_id = $order->id;
                        $history->date = Carbon::now();
                        $history->status = 'Payment Failed';
                        $history->save();
                    }
                }
            }else{
                $transaction = Transaction::where('payment_order_id', $order->transaction->payment_order_id )->first();
                if($transaction){

                    $transaction->status              = 'Cancelled';

                    $transaction->save();

                    $order = Order::where('transaction_id', $transaction->id)->first();
                    $order->payment_type            = "online";
                    $order->payment_status          = 'Cancelled';
                    $order->status                  = "Cancelled";
                    $order->save();

                    $history = new OrderHistory();
                    $history->order_id = $order->id;
                    $history->date = Carbon::now();
                    $history->status = 'Payment Failed';
                    $history->save();
                }
            }
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
