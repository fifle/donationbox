<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DonationController extends Controller
{
    public function donationLink(Request $request)
    {
        $request->validate([
            'campaign_title' => 'required|string|max:250',
            'detail' => 'required|string|max:250',
            'payee' => 'required|string|max:250',
        ]);

        if (!$request->has('campaign_title')) {
            return redirect()->route('welcome');
        } else {
            $campaign_title = urlencode($request->input('campaign_title'));
            $detail = urlencode($request->input('detail'));
            $payee = urlencode($request->input('payee'));
            $iban = urlencode($request->input('iban')); // Bank account number
            $pp = urlencode($request->input('pp')); // Paypal
            $pp_dp = urlencode($request->input('pp_dp')); // Paypal donation button - private account
            $pp_db = urlencode($request->input('pp_db')); // Paypal donation button - business account
            $db = urlencode($request->input('db')); // DonorBox
            $sebuid = urlencode($request->input('sebuid')); // SEB UID identification
            $rev = urlencode($request->input('rev')); // Revolut

            // links
            $link = sprintf(url('/donation?campaign_title=%s&detail=%s&payee=%s&iban=%s&pp=%s&db=%s&sebuid=%s&rev=%s&pp_dp=%s'),
                $campaign_title, $detail, $payee, $iban, $pp, $db, $sebuid, $rev, $pp_dp);
            $embedlink = sprintf(url('/embed?campaign_title=%s&detail=%s&payee=%s&iban=%s&pp=%s&db=%s&sebuid=%s&rev=%s'),
                $campaign_title, $detail, $payee, $iban, $pp, $db, $sebuid, $rev);

            // amount
            $amount = null;

            // QR-code generation
            $qrcode = QrCode::format('png')
                ->merge('img/db-logo-qr.png', .3, true)
                ->size(1920)
                ->generate($link);

            $compactData = array(
                'qrcode',
                'campaign_title',
                'detail',
                'payee',
                'iban',
                'pp',
                'db',
                'sebuid',
                'rev',
                'amount',
                'embedlink',
                'link',
                'pp_dp',
                'pp_db'
            );

            return view("donation", compact($compactData));
        }
    }

    public function donationEmbed(Request $request)
    {
        $request->validate([
            'campaign_title' => 'required|string|max:250',
            'detail' => 'required|string|max:250',
            'payee' => 'required|string|max:250',
        ]);

        if (!$request->has('campaign_title')) {
            return redirect()->route('welcome');
        } else {
            $campaign_title = urlencode($request->input('campaign_title'));
            $detail = urlencode($request->input('detail'));
            $payee = urlencode($request->input('payee'));
            $iban = urlencode($request->input('iban')); // Bank account number
            $pp = urlencode($request->input('pp')); // Paypal
            $pp_dp = urlencode($request->input('pp_dp')); // Paypal donation button - private account
            $pp_db = urlencode($request->input('pp_db')); // Paypal donation button - business account
            $db = urlencode($request->input('db')); // DonorBox
            $sebuid = urlencode($request->input('sebuid')); // SEB UID identification
            $rev = urlencode($request->input('rev')); // Revolut

            // links
            $link = sprintf(url('/donation?campaign_title=%s&detail=%s&payee=%s&iban=%s&pp=%s&db=%s&sebuid=%s&rev=%s&pp_dp=%s'),
                $campaign_title, $detail, $payee, $iban, $pp, $db, $sebuid, $rev, $pp_dp);
            $embedlink = sprintf(url('/embed?campaign_title=%s&detail=%s&payee=%s&iban=%s&pp=%s&db=%s&sebuid=%s&rev=%s'),
                $campaign_title, $detail, $payee, $iban, $pp, $db, $sebuid, $rev);

            // swedbank
            $amount = null;

            $compactData = array(
                'campaign_title',
                'detail',
                'payee',
                'iban',
                'pp',
                'db',
                'sebuid',
                'rev',
                'amount',
                'embedlink',
                'link',
                'pp_dp',
                'pp_db'
            );

            return view("embed", compact($compactData));
        }
    }

    // Generate PDF
    public function createPDF(Request $request)
    {

    }
}
