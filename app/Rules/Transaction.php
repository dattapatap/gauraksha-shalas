<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class Transaction implements Rule
{
    private $paymentid;
    public function __construct( $paymentid)
    {
       $this->paymentid = $paymentid;
    }

    public function passes($attribute, $value)
    {
       return DB::table('donors')
                    ->where('payment_id', $this->paymentid)
                    ->count() == 0;
    }

    public function message()
    {
        return 'Duplicate Transaction, Transaction id exist';
    }

}
