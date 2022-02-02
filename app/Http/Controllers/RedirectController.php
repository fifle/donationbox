<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RedirectController extends Controller
{
    public function getBankLink(Request $request) {
        $campaign_title = session('campaign_title');
        $detail = session('detail');
        $payee = session('payee');
        $iban = session('iban');
        $pp = session('pp');

        $amount = urlencode($request->input('donationsum'));


        switch ($request->input('action')) {
            case 'swed':
                $bankname = "Swedbank";
                $url = sprintf("https://www.swedbank.ee/private/d2d/payments2/domestic/new?payment.beneficiaryAccountNumber=%s&payment.beneficiaryName=%s&payment.details=%s&payment.amount=%s", $iban, $payee, $detail, $amount);
                return Redirect::to($url);

                // not working, needs UID value to be processed
            case 'seb':
                $bankname = "SEB";
                $url = sprintf("https://e.seb.ee/ip/ipank?act=SMARTPAYM&lang=EST&field1=benname&value1=%s&field3=benacc&value3=%s&field10=desc&value10=%s&value11=12345&field5=amount&value5=%s&paymtype=REMSEBEE&field6=currency&value6=EUR", $payee, $iban, $detail, $amount);
                return Redirect::to($url);

            case 'lhv':
                $bankname = "LHV";
                $url = sprintf("https://www.lhv.ee/portfolio/payment_out.cfm?i_receiver_name=%s&i_receiver_account_no=%s&i_payment_desc=%s&i_amount=%s", $payee, $iban, $detail, $amount);
                return Redirect::to($url);

                // needs fix for MakseSumma
            case 'coop':
                $bankname = "Coop Pank";
                $url = sprintf("https://i-pank.krediidipank.ee/newpmt?SaajaNimi=%s&SaajaKonto=%s&MaksePohjus=%s&MakseSumma=%s", $payee, $iban, $detail, $amount);
                return Redirect::to($url);

            case 'paypal':
                $bankname = "Paypal";
                $url = sprintf("https://paypal.me/%s/%sEUR", $pp, $amount);
                return Redirect::to($url);
        }


        $compactData=array(
            'bankname',
            'url',
            'campaign_title',
            'detail' ,
            'payee',
            'iban',
            'pp',
            'amount'
        );

        $data = array(
            'bankname' => $bankname,
            'url' => $url,
            'campaign_title' => $campaign_title,
            'detail' => $detail,
            'payee' => $payee,
            'iban' => $iban,
            'pp' => $pp,
            'amount' => $amount
        );

        return view("redirect", compact($compactData));
    }
}
