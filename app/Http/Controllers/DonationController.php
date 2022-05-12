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
            'payee' => 'required|string|max:250'
        ]);

        if (!$request->has('campaign_title')) {
            return redirect()->away('/');
//        } else if (in_array($request->input('iban'), $array)) {
//            return redirect()->away('/');
        }
        else {
            $campaign_title = rawurlencode($request->input('campaign_title'));
            $detail = rawurlencode($request->input('detail'));
            $payee = rawurlencode($request->input('payee'));
            $iban = rawurlencode($request->input('iban'));
            $pp = rawurlencode($request->input('pp'));
            $db = rawurlencode($request->input('db'));
            $sebuid = rawurlencode($request->input('sebuid'));
            $sebuid_st = rawurlencode($request->input('sebuid_st')); // uid for standing order for SEB LV
            $rev = rawurlencode($request->input('rev'));
            $tax = rawurlencode($request->boolean('tax'));
            $swt = rawurlencode($request->boolean('swt'));
            $lhvt = rawurlencode($request->boolean('lhvt'));
            $coopt = rawurlencode($request->boolean('coopt'));
            // paypal hosted button
            $pphb = rawurlencode($request->input('pphb'));

            // links
            $link = url()->full();
            $embedlink = str_replace("/donation?", "/embed?", $link);

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
//            if (env('COUNTRY') == 'ee'){
//                $qrcode = QrCode::format('png')
//                ->merge('img/db-logo-qr.png', .3, true)
//                    ->size(1920)
//                    ->generate(url()->full());
//            } else {
                $qrcode = QrCode::format('svg')
//                ->merge('img/db-logo-qr.png', .3, true)
                    ->size(250)
                    ->generate(url()->full());
//            }

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

            if (isset($swt)) {
                $compactData['swt'] = 'swt';
            }

            if (isset($lhvt)) {
                $compactData['lhvt'] = 'lhvt';
            }

            if (isset($coopt)) {
                $compactData['coopt'] = 'coopt';
            }

            if (isset($pphb)) {
                $compactData['pphb'] = 'pphb';
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
            $campaign_title = rawurlencode($request->input('campaign_title'));
            $detail = rawurlencode($request->input('detail'));
            $payee = rawurlencode($request->input('payee'));
            $iban = rawurlencode($request->input('iban'));
            $pp = rawurlencode($request->input('pp'));
            $db = rawurlencode($request->input('db'));
            $sebuid = rawurlencode($request->input('sebuid'));
            $sebuid_st = rawurlencode($request->input('sebuid_st')); // uid for standing order for SEB LV
            $rev = rawurlencode($request->input('rev'));
            $tax = rawurlencode($request->boolean('tax'));
            $swt = rawurlencode($request->boolean('swt'));
            $lhvt = rawurlencode($request->boolean('lhvt'));
            $coopt = rawurlencode($request->boolean('coopt'));
            // paypal hosted button
            $pphb = rawurlencode($request->input('pphb'));

            // links
            $link = url()->full();
            $embedlink = str_replace("/donation", "/embed", $link);

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

            if (isset($swt)) {
                $compactData['swt'] = 'swt';
            }

            if (isset($lhvt)) {
                $compactData['lhvt'] = 'lhvt';
            }

            if (isset($coopt)) {
                $compactData['coopt'] = 'coopt';
            }

            if (isset($pphb)) {
                $compactData['pphb'] = 'pphb';
            }

            return view("embed", compact($compactData));
        }
    }

    // Generate PDF
    public function createPDF(Request $request)
    {

    }
}
