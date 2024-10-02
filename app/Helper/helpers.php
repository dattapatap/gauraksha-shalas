<?php

use App\Models\ShippingRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

function calculateCouponDiscount($subTotal){


}


function calculateDiscountPercent($originalPrice, $discountPrice) {
    $discountAmount = $originalPrice - $discountPrice;
    $discountPercent = ($discountAmount / $originalPrice) * 100;
    return round($discountPercent);
}

function calculateDiscounAmount($originalPrice, $discountPer) {
    $discountAmount = ($originalPrice * $discountPer) / 100;
    $discountPercent = ($originalPrice  - $discountAmount );
    return round($discountPercent);
}


function getPercent($actual, $total){
    return round( ($actual / $total) * 100 );
}

function getDiscountPercents($product, $deal=null) {
    if(Auth::check()){
        if(isset(auth()->user()->rolecode) && auth()->user()->rolecode == 'Client'){
            if($deal)
                return $deal->client_discount;
            else
                return $product->client_discount;
        }else{
            if($deal)
                return $deal->distributor_discount;
            else
                return $product->client_discount;
        }
    }else{
        if($deal)
            return $deal->client_discount;
        else
            return $product->client_discount;

    }
}

function getPercentOfTotal($percentToGet, $myNumber){
    $percentInDecimal = $percentToGet / 100;
    $percent = $percentInDecimal * $myNumber;
    return round($percent,2);
}
function getActualPrice($percentToGet, $amount){    //Differntiate Inclusive Tax Amount
    $taxPriceCal = 100 + $percentToGet;
    $totalTax = ($amount/$taxPriceCal)*$percentToGet;
    return round(($amount - $totalTax), 2);
}

function getActualTaxValue($percentToGet, $amount){    //Differntiate Inclusive Tax Amount
    $taxPriceCal = 100 + $percentToGet;
    $totalTax = round(($amount/$taxPriceCal)*$percentToGet, 2);
    return $totalTax;
}

function getShippingAmount($amount){
    $shipRules = ShippingRule::where('deleted_at', null)->orderBy('min_cost', 'asc')->get();
    $shippingCost = 0;
    foreach($shipRules as $rule){
        if($amount <= $rule->min_cost ){
            $shippingCost = $rule->shipping_cost;
            break;
        }
    }
    return $shippingCost;
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



