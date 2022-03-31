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
            $iban = urlencode($request->input('iban'));
            $pp = urlencode($request->input('pp'));
            $db = urlencode($request->input('db'));
            $sebuid = urlencode($request->input('sebuid'));
            $sebuid_st = urlencode($request->input('sebuid_st')); // uid for standing order for SEB LV
            $rev = urlencode($request->input('rev'));
            $tax = urlencode($request->boolean('tax'));

            // links
//            $link = sprintf(url('/donation?campaign_title=%s&detail=%s&payee=%s&iban=%s&pp=%s&db=%s&sebuid=%s&rev=%s'),
//                $campaign_title, $detail, $payee, $iban, $pp, $db, $sebuid, $rev);
            $link = url()->full();
            $embedlink = sprintf(url('/embed?campaign_title=%s&detail=%s&payee=%s&iban=%s&pp=%s&db=%s&sebuid=%s&rev=%s'),
                $campaign_title, $detail, $payee, $iban, $pp, $db, $sebuid, $rev);

            // amount
            $amount = null;
            $ik = null;

            // services for background checking
            if (env('COUNTRY') == 'ee'){
                $bg_check = sprintf("https://www.teatmik.ee/en/search/%s", $payee);
            }
            if (env('COUNTRY') == 'lv'){
                $bg_check = sprintf("https://www.lursoft.lv/meklet?q=%s", $payee);
            }
            if (env('COUNTRY') == 'lt'){
                $bg_check = null; // TODO: missing lithuanian link for bg check service
            }

            // QR-code generation
            $qrcode = QrCode::format('svg')
//                ->merge('img/db-logo-qr.png', .3, true)
                ->size(250)
                ->generate(url()->full());

            $compactData = array(
                'qrcode',
                'campaign_title',
                'detail',
                'payee',
                'amount',
                'ik',
                'embedlink',
                'link',
                'bg_check',
            );

            if (isset($iban)) {
                $compactData['iban'] = 'iban';
            }

            if (isset($pp)) {
                $compactData['pp'] = 'pp';
            }

            if (isset($db)) {
                $compactData['db'] = 'db';
            }

            if (isset($sebuid)) {
                $compactData['sebuid'] = 'sebuid';
            }

            if (isset($sebuid_st)) {
                $compactData['sebuid_st'] = 'sebuid_st';
            }

            if (isset($rev)) {
                $compactData['rev'] = 'rev';
            }

            if (isset($tax)) {
                $compactData['tax'] = 'tax';
            }

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
            $iban = urlencode($request->input('iban'));
            $pp = urlencode($request->input('pp'));
            $db = urlencode($request->input('db'));
            $sebuid = urlencode($request->input('sebuid'));
            $sebuid_st = urlencode($request->input('sebuid_st')); // uid for standing order for SEB LV
            $rev = urlencode($request->input('rev'));
            $tax = urlencode($request->boolean('tax'));

            // links
            $link = sprintf(url('/donation?campaign_title=%s&detail=%s&payee=%s&iban=%s&pp=%s&db=%s&sebuid=%s&rev=%s'),
                $campaign_title, $detail, $payee, $iban, $pp, $db, $sebuid, $rev);
            $embedlink = sprintf(url('/embed?campaign_title=%s&detail=%s&payee=%s&iban=%s&pp=%s&db=%s&sebuid=%s&rev=%s'),
                $campaign_title, $detail, $payee, $iban, $pp, $db, $sebuid, $rev);

            $amount = null;
            $ik = null;

            // services for background checking
            if (env('COUNTRY') == 'ee'){
                $bg_check = sprintf("https://www.teatmik.ee/en/search/%s", $payee);
            }
            if (env('COUNTRY') == 'lv'){
                $bg_check = sprintf("https://www.lursoft.lv/meklet?q=%s", $payee);
            }
            if (env('COUNTRY') == 'lt'){
                $bg_check = null; // TODO: missing lithuanian link for bg check service
            }

            $compactData = array(
                'campaign_title',
                'detail',
                'payee',
                'amount',
                'ik',
                'embedlink',
                'link',
                'bg_check',
            );

            if (isset($iban)) {
                $compactData['iban'] = 'iban';
            }

            if (isset($pp)) {
                $compactData['pp'] = 'pp';
            }

            if (isset($db)) {
                $compactData['db'] = 'db';
            }

            if (isset($sebuid)) {
                $compactData['sebuid'] = 'sebuid';
            }

            if (isset($sebuid_st)) {
                $compactData['sebuid_st'] = 'sebuid_st';
            }

            if (isset($rev)) {
                $compactData['rev'] = 'rev';
            }

            if (isset($tax)) {
                $compactData['tax'] = 'tax';
            }

            return view("embed", compact($compactData));
        }
    }

    // Generate PDF
    public function createPDF(Request $request)
    {

    }
}
