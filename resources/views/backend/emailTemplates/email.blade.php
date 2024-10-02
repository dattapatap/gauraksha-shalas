<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php

?>

<head>
    <style>
        @page {
            margin: 0;
            size: letter;
        }
    </style>

</head>

<body style = "font-style: Lato">
    <table style="text-align: center; padding:10px;margin-top:10px;width:100%">
        <tr style="text-align: center;">
            <th style="text-align: center;">
                <img src="images/logo.png" alt="Logo" title="Logo" style="margin-left:-50px;border-radius:50%;width:10%">
            </th>
        </tr>
    </table>
    <!-- <hr style="margin-top:-10px;"> -->
    <table border="0" style ="text-align: center; padding:10px;margin-left:20px;margin-top:0px;">
        <tr>
            <th width="525" height="30" style = "font-size: 18px">DONATION RECEIPT</th>
        </tr>
        <tr>
            <th width="525" height="30" style = "font-size: 18px">PAN-00000000000</th>
        </tr>
        <tr>
            <td width="100">
                We confirm the receipt of donation from Mr/Mrs {{ $name }} {{ $pay_mode }}
                Rs.<?php echo number_format($amount, 2); ?>/-
            </td>
        </tr>
        <tr>
            <td width="100">
                Dated <?php if ($payment_date == '//' || $payment_date == '') {
                    echo $payment_date;
                } else {
                    $date = $payment_date;
                    echo date('d-M-Y', strtotime($date));
                } ?>
            </td>
        </tr>
    </table>
    <br><br>

    <table style = "border: 1px solid black;border-collapse: collapse; margin-left:120px;margin-right:80px;">
        <tr>
            <td width="210" height="40"style="border: 1px solid black;border-collapse: collapse;">
                &nbsp;&nbsp;&nbsp;Receipt Number</td>
            <td width="210"
                height="40"style="border: 1px solid black;border-collapse: collapse;text-align:center;">
                {{ $receipt_id }}</td>
        </tr>
        <tr>
            <td width="210" height="30" style = "border: 1px solid black;border-collapse: collapse;">
                &nbsp;&nbsp;&nbsp;Total Donation</td>
            <td width="210" height="30"
                style = "border: 1px solid black;border-collapse: collapse;text-align:center;">INR <?php echo number_format($amount, 2); ?>/-
            </td>
        </tr>
        <tr>
            <td width="210" height="30" style = "border: 1px solid black;border-collapse: collapse;">
                &nbsp;&nbsp;&nbsp;Receipt Date</td>
            <td width="210" height="30"
                style = "border: 1px solid black;border-collapse: collapse;text-align:center;"><?php if ($payment_date == '//' || $payment_date == '') {
                    echo $payment_date;
                } else {
                    $date = $payment_date;
                    echo date('d-M-Y', strtotime($date));
                } ?></td>
        </tr>
        <tr>
            <td width="210" height="30" style = "border: 1px solid black;border-collapse: collapse;">
                &nbsp;&nbsp;&nbsp;PAN Details of Donor</td>
            <td width="210" height="30"
                style = "border: 1px solid black;border-collapse: collapse; text-align:center;">{{ $pan }}</td>
        </tr>
        <tr>
            <td width="210" height="30" style = "border: 1px solid black;border-collapse: collapse;">
                &nbsp;&nbsp;&nbsp;Mode of Payment</td>
            <td width="210" height="30"
                style = "border: 1px solid black;border-collapse: collapse;text-align:center;"> {{ $pay_mode }}
            </td>
        </tr>
        <tr>
            <td width="210" height="30" style = "border: 1px solid black;border-collapse: collapse;">
                &nbsp;&nbsp;&nbsp;Amount in words</td>
            <td width="210" height="30"
                style = "border: 1px solid black;border-collapse: collapse;text-align:center;">{{ $amount_in_words }}
                Only</td>
        </tr>
    </table>

    <br>

    <table border="0" style = "margin-left:60px;padding-right:20px;width:100%">
        <br>

        <tr>
            <td style="font-weight: bold">
                Note:
            </td>
        </tr>
        <tr>
            <td>Donation are eligible for 50% deduction from taxable income under section 80G(5)(vi)
                of the Income Tax <br>Act 1961 vide approval no. CIT (E) 80G/P-000/000000000/000 (E)
                -1/Vol 0000-0000 <br> dated 00/00/0000, subject to realization of donation.
            </td>
        </tr>
        <tr>
            <td>
                <br>
                Authorized Signatory
            </td>
        </tr>
        <tr>
            <td>
                <img src="" alt="Logo" title="Logo" style="display:block" width="60">
            </td>
        </tr>
    </table>
    <table style = "margin-top:70px;">
        <tr>
            <th style="text-align: center;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Thank
                you for your generosity. We appreciate your support!
            <th>
        </tr>
    </table>
</body>

</html>
