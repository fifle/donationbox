<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use WhiteCube\Lingua\Service as Lingua;

class RedirectController extends Controller
{
    public function getBankLink(Request $request) {
        $campaign_title = rawurldecode($request->input('campaign_title'));
        $detail = rawurldecode($request->input('detail'));
        $payee = rawurldecode($request->input('payee'));
        $iban = rawurldecode($request->input('iban'));
        $pp = rawurldecode($request->input('pp'));
        $db = rawurldecode($request->input('db'));
        $sebuid = rawurldecode($request->input('sebuid'));
        $sebuid_st = rawurldecode($request->input('sebuid_st'));
        $rev = rawurldecode($request->input('rev'));
        $s0 = rawurldecode($request->input('s0'));
        if ($s0) {
            $amount = rawurldecode($request->input('s0'));
        } else {
            $amount = rawurldecode($request->input('donationsum'));
        }
        $ik = " " . rawurldecode($request->input('taxik'));
        // PayPal hosted button
        $pphb = rawurldecode($request->input('pphb'));

        // current language and its conversion from ISO_639_1 to ISO_639_2 for ibanks
        $currentLang = $request->session()->get('locale');
        switch ($currentLang) {
            case "":
            case "en":
                $currentLang = "ENG";
                break;
            case "ee":
                $currentLang = "EST";
                break;
            case "lv":
                $currentLang = "LAT";
                break;
            case "lt":
                $currentLang = "LIT";
                break;
            case "ru":
                $currentLang = "RUS";
                break;
        }

        if (env('COUNTRY') == 'ee') {
            switch ($request->input('action')) {
                case 'swed':
                    $bankname = "Swedbank";
                    $url = sprintf("https://www.swedbank.ee/private/d2d/payments2/smartNew?payment.beneficiaryAccountNumber=%s&payment.beneficiaryName=%s&payment.details=%s%s&payment.amount=%s&language=%s", $iban, $payee, $detail, $ik, $amount, $currentLang);
                    return Redirect::to($url);

                case 'swed-standing':
                    $bankname = "Swedbank";
                    $url = sprintf("https://www.swedbank.ee/private/d2d/payments2/standing_order/new?standingOrder.beneficiaryAccountNumber=%s&standingOrder.beneficiaryName=%s&standingOrder.details=%s%s&standingOrder.amount=%s&language=%s", $iban, $payee, $detail, $ik, $amount, $currentLang);
                    return Redirect::to($url);

                case 'seb':
                    $bankname = "SEB";
                    $url = sprintf("https://e.seb.ee/ip/ipank?UID=%s&act=SMARTPAYM&lang=%s&field1=benname&value1=%s&field3=benacc&value3=%s&field10=desc&value10=%s%s&value11=12345&field5=amount&value5=%s&paymtype=REMSEBEE&field6=currency&value6=EUR", $sebuid, $currentLang, $payee, $iban, $detail, $ik, $amount);
                    return Redirect::to($url);

                case 'seb-standing':
                    $bankname = "SEB";
                    $url = sprintf("https://e.seb.ee/ip/ipank?UID=%s&act=ADDSOSMARTPAYM&lang=%s&field1=benname&value1=%s&field3=benacc&value3=%s&field10=desc&value10=%s%s&field11=refid&value11=&field5=amount&value5=%s&sofield1=frequency&sovalue1=3&paymtype=REMSEBEE&field6=currency&value6=EUR&sofield2=startdt&sofield3=enddt", $sebuid_st, $currentLang, $payee, $iban, $detail, $ik, $amount);
                    return Redirect::to($url);

                case 'lhv':
                    $bankname = "LHV";
                    $url = sprintf("https://www.lhv.ee/portfolio/payment_out.cfm?i_receiver_name=%s&i_receiver_account_no=%s&i_payment_desc=%s%s&i_amount=%s", $payee, $iban, $detail, $ik, $amount);
                    return Redirect::to($url);

                case 'lhv-standing':
                    $bankname = "LHV";
                    $url = sprintf("https://www.lhv.ee/portfolio/payment_standing_add.cfm?i_receiver_name=%s&i_receiver_account_no=%s&i_payment_desc=%s%s&i_amount=%s", $payee, $iban, $detail, $ik, $amount);
                    return Redirect::to($url);

                // needs fix for MakseSumma
                case 'coop':
                    $bankname = "Coop Pank";
                    $url = sprintf("https://i.cooppank.ee/newpmt?SaajaNimi=%s&SaajaKonto=%s&MaksePohjus=%s%s&MuutMakseSumma=%s", $payee, $iban, $detail, $ik, $amount);
                    return Redirect::to($url);

                case 'coop-standing':
                    $bankname = "Coop Pank";
                    $url = sprintf("https://i.cooppank.ee/permpmtnew?SaajaNimi=%s&SaajaKonto=%s&MaksePohjus=%s%s&MakseSumma=%s", $payee, $iban, $detail, $ik, $amount);
                    return Redirect::to($url);

                case 'paypal':
                    $bankname = "Paypal";
                    $url = sprintf("https://paypal.me/%s/%sEUR", $pp, $amount);
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

                case 'pphb':
                    $bankname = "Paypal Hosted button";
                    $url = sprintf("https://www.paypal.com/donate/?hosted_button_id=%s", $pphb);
                    return Redirect::to($url);
            }
        } else if (env('COUNTRY') == 'lv') {
            switch ($request->input('action')) {
                case 'swed':
                    $bankname = "Swedbank";
                    $url = sprintf("https://www.swedbank.lv/private/d2d/payments2/smartNew?payment.beneficiaryAccountNumber=%s&payment.beneficiaryName=%s&payment.details=%s%s&payment.amount=%s&language=%s", $iban, $payee, $detail, $ik, $amount, $currentLang);
                    error_log($url);
                    return Redirect::to($url);

                case 'swed-standing':
                    $bankname = "Swedbank";
                    $url = sprintf("https://www.swedbank.lv/private/d2d/payments2/standing_order/new?standingOrder.beneficiaryAccountNumber=%s&standingOrder.beneficiaryName=%s&standingOrder.details=%s%s&standingOrder.amount=%s&language=%s", $iban, $payee, $detail, $ik, $amount, $currentLang);
                    error_log($url);
                    return Redirect::to($url);

                case 'seb':
                    $bankname = "SEB";
                    $url = sprintf("https://ibanka.seb.lv/ip/ipank?UID=%s&act=SMARTPAYM&lang=%s&field1=benname&value1=%s&field3=benacc&value3=%s&field10=desc&value10=%s%s&value11=12345&field5=amount&value5=%s&paymtype=REMSEBEE&field6=currency&value6=EUR", $sebuid, $currentLang, $payee, $iban, $detail, $ik, $amount);
                    error_log($url);
                    return Redirect::to($url);

                case 'seb-standing':
                    $bankname = "SEB";
                    $url = sprintf("https://ibanka.seb.lv/ip/ipank?UID=%s&act=ADDSOSMARTPAYM&lang=%s&field1=benname&value1=%s&field3=benacc&value3=%s&field10=desc&value10=%s%s&field11=refid&value11=&field5=amount&value5=%s&sofield1=frequency&sovalue1=3&paymtype=REMSEBEE&field6=currency&value6=EUR&sofield2=startdt&sofield3=enddt", $sebuid_st, $currentLang, $payee, $iban, $detail, $ik, $amount);
                    error_log($url);
                    return Redirect::to($url);

                case 'paypal':
                    $bankname = "Paypal";
                    $url = sprintf("https://paypal.me/%s/%sEUR", $pp, $amount);
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

                case 'pphb':
                    $bankname = "Paypal Hosted button";
                    $url = sprintf("https://www.paypal.com/donate/?hosted_button_id=%s", $pphb);
                    return Redirect::to($url);
            }
        } else if (env('COUNTRY') == 'lt') {
            switch ($request->input('action')) {
                case 'swed':
                    $bankname = "Swedbank";
                    $url = sprintf("https://www.swedbank.lt/private/d2d/payments2/smartNew?payment.beneficiaryAccountNumber=%s&payment.beneficiaryName=%s&payment.details=%s&payment.amount=%s&language=%s", $iban, $payee, $detail, $amount, $currentLang);
                    return Redirect::to($url);

                case 'swed-standing':
                    $bankname = "Swedbank";
                    $url = sprintf("https://www.swedbank.lt/private/d2d/payments2/standing_order/new?standingOrder.beneficiaryAccountNumber=%s&standingOrder.beneficiaryName=%s&standingOrder.details=%s&standingOrder.amount=%s&language=%s", $iban, $payee, $detail, $amount, $currentLang);
                    return Redirect::to($url);

                case 'seb':
                    $bankname = "SEB";
                    $url = sprintf("https://e.seb.lt/ip/ipank?UID=%s&act=SMARTPAYM&lang=%s&field1=benname&value1=%s&field3=benacc&value3=%s&field10=desc&value10=%s&value11=12345&field5=amount&value5=%s&paymtype=REMSEBEE&field6=currency&value6=EUR", $sebuid, $currentLang, $payee, $iban, $detail, $amount);
                    return Redirect::to($url);

                case 'seb-standing':
                    $bankname = "SEB";
                    $url = sprintf("https://e.seb.lt/ip/ipank?UID=%s&act=ADDSOSMARTPAYM&lang=%s&field1=benname&value1=%s&field3=benacc&value3=%s&field10=desc&value10=%s&field11=refid&value11=&field5=amount&value5=%s&sofield1=frequency&sovalue1=3&paymtype=REMSEBEE&field6=currency&value6=EUR&sofield2=startdt&sofield3=enddt", $sebuid_st, $currentLang, $payee, $iban, $detail, $amount);
                    return Redirect::to($url);

                case 'paypal':
                    $bankname = "Paypal";
                    $url = sprintf("https://paypal.me/%s/%sEUR", $pp, $amount);
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

                case 'pphb':
                    $bankname = "Paypal Hosted button";
                    $url = sprintf("https://www.paypal.com/donate/?hosted_button_id=%s", $pphb);
                    return Redirect::to($url);
            }
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
            'sebuid_st',
            'rev',
            'amount',
            'ik',
            'pphb',
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
            'sebuid_st' => $sebuid_st,
            'rev' => $rev,
            'amount' => $amount,
            'ik' => $ik,
            'pphb' => $pphb,
        );

        return view("redirect", compact($compactData));
    }
}
