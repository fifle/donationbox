<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RedirectController extends Controller
{
    public function getBankLink(Request $request) {
        $campaign_title = session('campaign_title');
        $detail = urldecode($request->input('detail'));
        $payee = urldecode($request->input('payee'));
        $iban = urldecode($request->input('iban'));
        $pp = urldecode($request->input('pp'));
        $db = urldecode($request->input('db'));
        $sebuid = urldecode($request->input('sebuid'));
        $rev = urldecode($request->input('rev'));
        $pp_dp = urldecode($request->input('pp_dp')); // Paypal donation button - private account
        $pp_db = urldecode($request->input('pp_db')); // Paypal donation button - business account
        $amount = urldecode($request->input('donationsum'));

        switch ($request->input('action')) {
            case 'swed':
                $bankname = "Swedbank";
                $url = sprintf("https://www.swedbank.ee/private/d2d/payments2/domestic/new?payment.beneficiaryAccountNumber=%s&payment.beneficiaryName=%s&payment.details=%s&payment.amount=%s", $iban, $payee, $detail, $amount);
                return Redirect::to($url);

            case 'swed-standing':
                $bankname = "Swedbank";
                $url = sprintf("https://www.swedbank.ee/private/d2d/payments2/standing_order/new?standingOrder.beneficiaryAccountNumber=%s&standingOrder.beneficiaryName=%s&standingOrder.details=%s&standingOrder.amount=%s", $iban, $payee, $detail, $amount);
                return Redirect::to($url);

            case 'seb':
                $bankname = "SEB";
                $url = sprintf("https://e.seb.ee/ip/ipank?UID=%s&act=SMARTPAYM&lang=EST&field1=benname&value1=%s&field3=benacc&value3=%s&field10=desc&value10=%s&value11=12345&field5=amount&value5=%s&paymtype=REMSEBEE&field6=currency&value6=EUR", $sebuid, $payee, $iban, $detail, $amount);
                return Redirect::to($url);

            case 'seb-standing':
                $bankname = "SEB";
                $url = sprintf("https://e.seb.ee/ip/ipank?UID=%s&act=ADDSOSMARTPAYM&lang=EST&field1=benname&value1=%s&field3=benacc&value3=%s&field10=desc&value10=%s&field11=refid&value11=&field5=amount&value5=%s&sofield1=frequency&sovalue1=3&paymtype=REMSEBEE&field6=currency&value6=EUR&sofield2=startdt&sofield3=enddt", $sebuid, $payee, $iban, $detail, $amount);
                return Redirect::to($url);

            case 'lhv':
                $bankname = "LHV";
                $url = sprintf("https://www.lhv.ee/portfolio/payment_out.cfm?i_receiver_name=%s&i_receiver_account_no=%s&i_payment_desc=%s&i_amount=%s", $payee, $iban, $detail, $amount);
                return Redirect::to($url);

            case 'lhv-standing':
                $bankname = "LHV";
                $url = sprintf("https://www.lhv.ee/portfolio/payment_standing_add.cfm?i_receiver_name=%s&i_receiver_account_no=%s&i_payment_desc=%s&i_amount=%s", $payee, $iban, $detail, $amount);
                return Redirect::to($url);

                // needs fix for MakseSumma
            case 'coop':
                $bankname = "Coop Pank";
                $url = sprintf("https://i-pank.krediidipank.ee/newpmt?SaajaNimi=%s&SaajaKonto=%s&MaksePohjus=%s&MakseSumma=%s", $payee, $iban, $detail, $amount);
                return Redirect::to($url);

            case 'coop-standing':
                $bankname = "Coop Pank";
                $url = sprintf("https://i-pank.krediidipank.ee/permpmtnew?SaajaNimi=%s&SaajaKonto=%s&MaksePohjus=%s&MakseSumma=%s", $payee, $iban, $detail, $amount);
                return Redirect::to($url);

            case 'paypal':
                $bankname = "Paypal";
                $url = sprintf("https://paypal.me/%s/%sEUR", $pp, $amount);
                return Redirect::to($url);

            case 'pp_dp':
                $bankname = "Paypal";
                $url = sprintf("https://www.paypal.com/donate/?business=%s&amount=%s&no_recurring=0&item_name=%s&currency_code=EUR", $pp_dp, $amount, $campaign_title);
                return Redirect::to($url);

            case 'pp_db':
                $bankname = "Paypal";
                $url = sprintf("https://www.paypal.com/donate/?hosted_button_id=%s", $pp);
                return Redirect::to($url);

            case 'donorbox':
                $bankname = "Donorbox";
                $url = sprintf("https://donorbox.org/%s?&amount=%s&default_interval=&currency=eur", $db, $amount);
                return Redirect::to($url);

            case 'donorbox-standing':
                $bankname = "Donorbox";
                $url = sprintf("https://donorbox.org/%s?&amount=%s&default_interval=m&currency=eur", $db, $amount);
                return Redirect::to($url);

            case 'rev':
                $bankname = "Revolut";
                $url = sprintf("https://revolut.me/%s", $rev);
                return Redirect::to($url);
        }

        $compactData = array(
            'bankname',
            'url',
            'campaign_title',
            'detail' ,
            'payee',
            'iban',
            'pp',
            'sebuid',
            'rev',
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
            'sebuid' => $sebuid,
            'rev' => $rev,
            'amount' => $amount
        );

        return view("redirect", compact($compactData));
    }
}
