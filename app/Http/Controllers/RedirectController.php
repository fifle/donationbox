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
    public function getBankLink(Request $request)
    {
        // Generate the bank URL based on the action
            $bankname = null;
            $url = null;

        // Campaign title text
        $campaign_title = rawurldecode($request->input("campaign_title"));
        // Payment detail text
        $detail = rawurldecode($request->input("detail"));
        // Payee's name
        $payee = rawurldecode($request->input("payee"));
        // IBAN number of the payee's bank account
        $iban = rawurldecode($request->input("iban"));
        // PayPal.me ID
        $pp = rawurldecode($request->input("pp"));
        // Donorbox campaign ID
        $db = rawurldecode($request->input("db"));
        // SEB UID for one-time payments
        $sebuid = rawurldecode($request->input("sebuid"));
        // SEB UID for standing payments
        $sebuid_st = rawurldecode($request->input("sebuid_st"));
        // Revolut id
        $rev = rawurldecode($request->input("rev"));
        // Donor's personal code
        $ik = " " . rawurldecode($request->input("taxik"));
        // PayPal hosted button
        $pphb = rawurldecode($request->input("pphb"));
        // Stripe payment link id
        $strp = rawurldecode($request->input("strp"));

        // Current logic for presetting the starting donation amount
        $s0 = rawurldecode($request->input("s0"));
        if ($s0) {
            $amount = rawurldecode($request->input("s0"));
        } else {
            $amount = rawurldecode($request->input("donationsum"));
        }

        // Setting current language code and its conversion from ISO_639_1 to ISO_639_2 for ibanks
        $currentLang = $request->session()->get("locale");
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

        // List for Estonian users
        if (env("COUNTRY") == "ee") {
            switch ($request->input("action")) {
                // Swedbank one-time payment
                case "swed":
                    $bankname = "Swedbank";
                    $url = sprintf(
                        "https://www.swedbank.ee/private/d2d/payments2/smartNew?payment.beneficiaryAccountNumber=%s&payment.beneficiaryName=%s&payment.details=%s%s&payment.amount=%s&language=%s",
                        $iban,
                        $payee,
                        $detail,
                        $ik,
                        $amount,
                        $currentLang
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                // Swedbank standing payment
                case "swed-standing":
                    $bankname = "Swedbank";
                    $url = sprintf(
                        "https://www.swedbank.ee/private/d2d/payments2/standing_order/new?standingOrder.beneficiaryAccountNumber=%s&standingOrder.beneficiaryName=%s&standingOrder.details=%s%s&standingOrder.amount=%s&language=%s",
                        $iban,
                        $payee,
                        $detail,
                        $ik,
                        $amount,
                        $currentLang
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                // SEB one-time payment
                case "seb":
                    $bankname = "SEB";
                    $url = sprintf(
                        "https://e.seb.ee/ib/login?UID=%s&act=SMARTPAYM&lang=%s&field1=benname&value1=%s&field3=benacc&value3=%s&field10=desc&value10=%s%s&value11=12345&field5=amount&value5=%s&paymtype=REMSEBEE&field6=currency&value6=EUR",
                        $sebuid,
                        $currentLang,
                        $payee,
                        $iban,
                        $detail,
                        $ik,
                        $amount
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                // SEB standing payment
                case "seb-standing":
                    $bankname = "SEB";
                    $url = sprintf(
                        "https://e.seb.ee/ib/login?UID=%s&act=ADDSOSMARTPAYM&lang=%s&field1=benname&value1=%s&field3=benacc&value3=%s&field10=desc&value10=%s%s&field11=refid&value11=&field5=amount&value5=%s&sofield1=frequency&sovalue1=3&paymtype=REMSEBEE&field6=currency&value6=EUR&sofield2=startdt&sofield3=enddt",
                        $sebuid_st,
                        $currentLang,
                        $payee,
                        $iban,
                        $detail,
                        $ik,
                        $amount
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                // LHV one-time payment
                case "lhv":
                    $bankname = "LHV";
                    $url = sprintf(
                        "https://www.lhv.ee/ibank/payments?creditorName=%s&creditorAccountNo=%s&description=%s%s&amount=%s",
                        $payee,
                        $iban,
                        $detail,
                        $ik,
                        $amount
                    );
                    error_log($url);
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                // LHV standing payment
                case "lhv-standing":
                    $bankname = "LHV";
                    $url = sprintf(
                        "https://www.lhv.ee/portfolio/payment_standing_add.cfm?i_receiver_name=%s&i_receiver_account_no=%s&i_payment_desc=%s%s&i_amount=%s",
                        $payee,
                        $iban,
                        $detail,
                        $ik,
                        $amount
                    );
                    error_log($url);
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                // Coop one-time payment
                case "coop":
                    $bankname = "Coop Pank";
                    $url = sprintf(
                        "https://i.cooppank.ee/newpmt?SaajaNimi=%s&SaajaKonto=%s&MaksePohjus=%s%s&MuutMakseSumma=%s",
                        $payee,
                        $iban,
                        $detail,
                        $ik,
                        $amount
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                // Coop standing payment
                case "coop-standing":
                    $bankname = "Coop Pank";
                    $url = sprintf(
                        "https://i.cooppank.ee/permpmtnew?SaajaNimi=%s&SaajaKonto=%s&MaksePohjus=%s%s&MakseSumma=%s",
                        $payee,
                        $iban,
                        $detail,
                        $ik,
                        $amount
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                // PayPal.me payment link (personal and business accounts)
                case "paypal":
                    $bankname = "Paypal";
                    $url = sprintf("https://paypal.me/%s/%sEUR", $pp, $amount);
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                // PayPal hosted button / donation payment link (for business accounts only)
                case "pphb":
                    $bankname = "Paypal Hosted button";
                    $url = sprintf(
                        "https://www.paypal.com/donate/?hosted_button_id=%s",
                        $pphb
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                // Donationbox campaign link for one-time payments
                case "donorbox":
                    $bankname = "Donorbox";
                    $url = sprintf(
                        "https://donorbox.org/%s?&amount=%s&default_interval=&currency=eur",
                        $db,
                        $amount
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                // Donationbox campaign link for standing payments
                case "donorbox-standing":
                    $bankname = "Donorbox";
                    $url = sprintf(
                        "https://donorbox.org/%s?&amount=%s&default_interval=m&currency=eur",
                        $db,
                        $amount
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                // Revolut payment link for one-time payments (personal accounts only)
                case "rev":
                    $bankname = "Revolut";
                    $url = sprintf(
                        "https://revolut.me/%s/eur%s/%s%s",
                        $rev,
                        $amount,
                        $detail,
                        $ik
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                // Stripe payment link for one-time payments (business accounts only)
                case "strp":
                    $bankname = "Stripe";
                    $url = sprintf(
                        "https://donate.stripe.com/%s?__prefilled_amount=%s%s&client_reference_id=%s",
                        $strp,
                        $amount,
                        "00",
                        $ik
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);
            }
        }
        // List for Latvian users
        elseif (env("COUNTRY") == "lv") {
            switch ($request->input("action")) {
                case "swed":
                    $bankname = "Swedbank";
                    $url = sprintf(
                        "https://www.swedbank.lv/private/d2d/payments2/smartNew?payment.beneficiaryAccountNumber=%s&payment.beneficiaryName=%s&payment.details=%s%s&payment.amount=%s&language=%s",
                        $iban,
                        $payee,
                        $detail,
                        $ik,
                        $amount,
                        $currentLang
                    );
                    error_log($url);
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                case "swed-standing":
                    $bankname = "Swedbank";
                    $url = sprintf(
                        "https://www.swedbank.lv/private/d2d/payments2/standing_order/new?standingOrder.beneficiaryAccountNumber=%s&standingOrder.beneficiaryName=%s&standingOrder.details=%s%s&standingOrder.amount=%s&language=%s",
                        $iban,
                        $payee,
                        $detail,
                        $ik,
                        $amount,
                        $currentLang
                    );
                    error_log($url);
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                case "seb":
                    $bankname = "SEB";
                    $url = sprintf(
                        "https://ibanka.seb.lv/ib/login?UID=%s&act=SMARTPAYM&lang=%s&field1=benname&value1=%s&field3=benacc&value3=%s&field10=desc&value10=%s%s&value11=12345&field5=amount&value5=%s&paymtype=REMSEBEE&field6=currency&value6=EUR",
                        $sebuid,
                        $currentLang,
                        $payee,
                        $iban,
                        $detail,
                        $ik,
                        $amount
                    );
                    error_log($url);
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                case "seb-standing":
                    $bankname = "SEB";
                    $url = sprintf(
                        "https://ibanka.seb.lv/ib/login?UID=%s&act=ADDSOSMARTPAYM&lang=%s&field1=benname&value1=%s&field3=benacc&value3=%s&field10=desc&value10=%s%s&field11=refid&value11=&field5=amount&value5=%s&sofield1=frequency&sovalue1=3&paymtype=REMSEBEE&field6=currency&value6=EUR&sofield2=startdt&sofield3=enddt",
                        $sebuid_st,
                        $currentLang,
                        $payee,
                        $iban,
                        $detail,
                        $ik,
                        $amount
                    );
                    error_log($url);
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                // PayPal.me payment link (personal and business accounts)
                case "paypal":
                    $bankname = "Paypal";
                    $url = sprintf("https://paypal.me/%s/%sEUR", $pp, $amount);
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                // PayPal hosted button / donation payment link (for business accounts only)
                case "pphb":
                    $bankname = "Paypal Hosted button";
                    $url = sprintf(
                        "https://www.paypal.com/donate/?hosted_button_id=%s",
                        $pphb
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                case "donorbox":
                    $bankname = "Donorbox";
                    $url = sprintf(
                        "https://donorbox.org/%s?&amount=%s&default_interval=&currency=eur",
                        $db,
                        $amount
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                case "donorbox-standing":
                    $bankname = "Donorbox";
                    $url = sprintf(
                        "https://donorbox.org/%s?&amount=%s&default_interval=m&currency=eur",
                        $db,
                        $amount
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                case "rev":
                    $bankname = "Revolut";
                    $url = sprintf(
                        "https://revolut.me/%s/eur%s/%s%s",
                        $rev,
                        $amount,
                        $detail,
                        $ik
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                case "strp":
                    $bankname = "Stripe";
                    $url = sprintf(
                        "https://donate.stripe.com/%s?__prefilled_amount=%s%s",
                        $strp,
                        $amount,
                        "00"
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                case "pphb":
                    $bankname = "Paypal Hosted button";
                    $url = sprintf(
                        "https://www.paypal.com/donate/?hosted_button_id=%s",
                        $pphb
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);
            }
        }
        // List for Lithuanian users
        elseif (env("COUNTRY") == "lt") {
            switch ($request->input("action")) {
                case "swed":
                    $bankname = "Swedbank";
                    $url = sprintf(
                        "https://www.swedbank.lt/private/d2d/payments2/smartNew?payment.beneficiaryAccountNumber=%s&payment.beneficiaryName=%s&payment.details=%s&payment.amount=%s&language=%s",
                        $iban,
                        $payee,
                        $detail,
                        $amount,
                        $currentLang
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                case "swed-standing":
                    $bankname = "Swedbank";
                    $url = sprintf(
                        "https://www.swedbank.lt/private/d2d/payments2/standing_order/new?standingOrder.beneficiaryAccountNumber=%s&standingOrder.beneficiaryName=%s&standingOrder.details=%s&standingOrder.amount=%s&language=%s",
                        $iban,
                        $payee,
                        $detail,
                        $amount,
                        $currentLang
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                case "seb":
                    $bankname = "SEB";
                    $url = sprintf(
                        "https://e.seb.lt/ib/login?UID=%s&act=SMARTPAYM&lang=%s&field1=benname&value1=%s&field3=benacc&value3=%s&field10=desc&value10=%s&value11=12345&field5=amount&value5=%s&paymtype=REMSEBEE&field6=currency&value6=EUR",
                        $sebuid,
                        $currentLang,
                        $payee,
                        $iban,
                        $detail,
                        $amount
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                case "seb-standing":
                    $bankname = "SEB";
                    $url = sprintf(
                        "https://e.seb.lt/ib/login?UID=%s&act=ADDSOSMARTPAYM&lang=%s&field1=benname&value1=%s&field3=benacc&value3=%s&field10=desc&value10=%s&field11=refid&value11=&field5=amount&value5=%s&sofield1=frequency&sovalue1=3&paymtype=REMSEBEE&field6=currency&value6=EUR&sofield2=startdt&sofield3=enddt",
                        $sebuid_st,
                        $currentLang,
                        $payee,
                        $iban,
                        $detail,
                        $amount
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                // PayPal.me payment link (personal and business accounts)
                case "paypal":
                    $bankname = "Paypal";
                    $url = sprintf("https://paypal.me/%s/%sEUR", $pp, $amount);
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                // PayPal hosted button / donation payment link (for business accounts only)
                case "pphb":
                    $bankname = "Paypal Hosted button";
                    $url = sprintf(
                        "https://www.paypal.com/donate/?hosted_button_id=%s",
                        $pphb
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                case "donorbox":
                    $bankname = "Donorbox";
                    $url = sprintf(
                        "https://donorbox.org/%s?&amount=%s&default_interval=&currency=eur",
                        $db,
                        $amount
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                case "donorbox-standing":
                    $bankname = "Donorbox";
                    $url = sprintf(
                        "https://donorbox.org/%s?&amount=%s&default_interval=m&currency=eur",
                        $db,
                        $amount
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                case "rev":
                    $bankname = "Revolut";
                    $url = sprintf(
                        "https://revolut.me/%s/eur%s/%s%s",
                        $rev,
                        $amount,
                        $detail,
                        $ik
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                case "strp":
                    $bankname = "Stripe";
                    $url = sprintf(
                        "https://donate.stripe.com/%s?__prefilled_amount=%s%s",
                        $strp,
                        $amount,
                        "00"
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);

                case "pphb":
                    $bankname = "Paypal Hosted button";
                    $url = sprintf(
                        "https://www.paypal.com/donate/?hosted_button_id=%s",
                        $pphb
                    );
                    return view('redirect', [
        'bankname' => $bankname,
        'url' => $url,
        'campaign_title' => $campaign_title
    ]);
            }
        }

        $compactData = [
            "bankname",
            "url",
            "campaign_title",
            "detail",
            "payee",
            "iban",
            "pp",
            "sebuid",
            "sebuid_st",
            "rev",
            "strp",
            "amount",
            "ik",
            "pphb",
        ];

        $data = [
            "bankname" => $bankname,
            "url" => $url,
            "campaign_title" => $campaign_title,
            "detail" => $detail,
            "payee" => $payee,
            "iban" => $iban,
            "pp" => $pp,
            "sebuid" => $sebuid,
            "sebuid_st" => $sebuid_st,
            "rev" => $rev,
            "strp" => $strp,
            "amount" => $amount,
            "ik" => $ik,
            "pphb" => $pphb,
        ];

        // return view("redirect", compact($compactData));
        //
        // Store the URL in session for confirmation
        // Store redirect data in session
        session([
            "pending_redirect" => [
                "url" => $url,
                "bankname" => $bankname ?? null,
                "campaign_title" => $campaign_title ?? null,
                "timestamp" => time(),
            ],
        ]);

        return response()->view("redirect", [
            "url" => $url,
            "bankname" => $bankname ?? null,
            "campaign_title" => $campaign_title ?? null,
        ]);
    }

    public function confirmRedirect(Request $request)
    {
        $pendingRedirect = session("pending_redirect");

        if (!$pendingRedirect || !isset($pendingRedirect["url"])) {
            return redirect()->route("donation");
        }

        // Clear the pending redirect from session
        session()->forget("pending_redirect");

        if ($request->ajax()) {
            return response()->json([
                "redirect_url" => $pendingRedirect["url"],
            ]);
        }

        return redirect()->away($pendingRedirect["url"]);
    }
}
