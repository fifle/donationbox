<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DonationController extends Controller
{
    public function donationLink(Request $request)
    {
        $request->validate([
//          'campaign_title' => 'required|string|max:250',
            'detail' => 'required|string|max:250',
            'payee' => 'required|string|max:250',
        ]);

            // Handle locale parameter
            $locale = $request->input('locale');
            if ($locale) {
                $validLocales = ['en', 'ru', 'ee', 'lv', 'lt'];
                if (in_array($locale, $validLocales)) {
                    app()->setLocale($locale);
                    session()->put('locale', $locale);
                }
            }

            $campaign_title = rawurlencode($request->input('campaign_title'));
            $detail = rawurlencode($request->input('detail'));
            $payee = rawurlencode($request->input('payee'));
            $iban = rawurlencode($request->input('iban'));
            $pp = rawurlencode($request->input('pp'));
            $db = rawurlencode($request->input('db'));
            $sebuid = rawurlencode($request->input('sebuid')); // UID for One-time payments for SEB
            $sebuid_st = rawurlencode($request->input('sebuid_st')); // UID for Standing orders for SEB
            $rev = rawurlencode($request->input('rev'));
            $tax = rawurlencode($request->boolean('tax'));
            $swt = rawurlencode($request->boolean('swt'));
            $lhvt = rawurlencode($request->boolean('lhvt'));
            $coopt = rawurlencode($request->boolean('coopt'));
            // PayPal hosted button
            $pphb = rawurlencode($request->input('pphb'));
            // Stripe payment link id
            $strp = rawurlencode($request->input('strp'));
            $paypalClientId = rawurlencode($request->input('paypalClientId')); // Paypal Hosted Button

            // Use directly without rawurlencode for internal logic
            $onetime = $request->has('onetime') ? filter_var($request->input('onetime'), FILTER_VALIDATE_BOOLEAN) : true;
            $recurring = $request->has('recurring') ? filter_var($request->input('recurring'), FILTER_VALIDATE_BOOLEAN) : true;

            // Custom sums setup
            $defsum = 5;
            $s1 = rawurlencode($request->input('s1'));
            $s2 = rawurlencode($request->input('s2'));
            $s3 = rawurlencode($request->input('s3'));

            // Fixed amount expected from the donor
            // In this case, all pre-defined amount selections will be disabled
            $s0 = rawurlencode($request->input('s0'));

            // links
            $link = url()->full();
            $changeHttpPrefix = str_replace("http://", "https://", $link);
            $embedlink = str_replace("/donation?", "/embed?", $changeHttpPrefix);

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
                'defsum'
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

            if (isset($strp)) {
                $compactData['strp'] = 'strp';
            }

            if (isset($paypalClientId)) {
                $compactData['paypalClientId'] = 'paypalClientId';
            }

            if (isset($s1)) {
                $compactData['s1'] = 's1';
            }

            if (isset($s2)) {
                $compactData['s2'] = 's2';
            }

            if (isset($s3)) {
                $compactData['s3'] = 's3';
            }

            if (isset($s0)) {
                $compactData['s0'] = 's0';
            }

            if (isset($onetime)) {
                $compactData['onetime'] = 'onetime';
            }

            if (isset($recurring)) {
                $compactData['recurring'] = 'recurring';
            }

            return view("donation", compact($compactData));
        }

    public function donationEmbed(Request $request)
    {
        $request->validate([
//            'campaign_title' => 'required|string|max:250',
            'detail' => 'required|string|max:250',
            'payee' => 'required|string|max:250',
        ]);

            // Handle locale for widgets
            $locale = $request->input('locale');
            if ($locale) {
                $validLocales = ['en', 'ru', 'ee', 'lv', 'lt'];
                if (in_array($locale, $validLocales)) {
                    app()->setLocale($locale);
                    session()->put('locale', $locale);
                }
            }

            $campaign_title = rawurlencode($request->input('campaign_title'));
            $detail = rawurlencode($request->input('detail'));
            $payee = rawurlencode($request->input('payee'));
            $iban = rawurlencode($request->input('iban'));
            $pp = rawurlencode($request->input('pp'));
            $db = rawurlencode($request->input('db'));
            $sebuid = rawurlencode($request->input('sebuid'));
            $sebuid_st = rawurlencode($request->input('sebuid_st')); // SEB standing orders
            $rev = rawurlencode($request->input('rev'));
            $tax = rawurlencode($request->boolean('tax'));
            $swt = rawurlencode($request->boolean('swt')); // Swed turn off
            $lhvt = rawurlencode($request->boolean('lhvt')); // LHV turn off
            $coopt = rawurlencode($request->boolean('coopt')); // Coop turn off
            $pphb = rawurlencode($request->input('pphb')); // Paypal Hosted Button
            $strp = rawurlencode($request->input('strp')); // Stripe
            $paypalClientId = rawurlencode($request->input('paypalClientId')); // Paypal Hosted Button

        // Use directly without rawurlencode for internal logic
        $onetime = $request->has('onetime') ? filter_var($request->input('onetime'), FILTER_VALIDATE_BOOLEAN) : true;
        $recurring = $request->has('recurring') ? filter_var($request->input('recurring'), FILTER_VALIDATE_BOOLEAN) : true;

            // custom sums
            $defsum = 5;
            $s1 = rawurlencode($request->input('s1'));
            $s2 = rawurlencode($request->input('s2'));
            $s3 = rawurlencode($request->input('s3'));

            // a fixed amount expected from the donor
            // then all preamounts are disabled
            $s0 = rawurlencode($request->input('s0'));

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
                'defsum'
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

            if (isset($strp)) {
                $compactData['strp'] = 'strp';
            }

            if (isset($paypalClientId)) {
                $compactData['paypalClientId'] = 'paypalClientId';
            }

            if (isset($s1)) {
                $compactData['s1'] = 's1';
            }

            if (isset($s2)) {
                $compactData['s2'] = 's2';
            }

            if (isset($s3)) {
                $compactData['s3'] = 's3';
            }

            if (isset($s0)) {
                $compactData['s0'] = 's0';
            }

            if (isset($onetime)) {
                $compactData['onetime'] = 'onetime';
            }

            if (isset($recurring)) {
                $compactData['recurring'] = 'recurring';
            }

            return view("embed", compact($compactData));
        }

    public function cashier(Request $request)
    {
        $request->validate([
//            'campaign_title' => 'required|string|max:250',
            'detail' => 'required|string|max:250',
            'payee' => 'required|string|max:250',
        ]);

        // Handle locale parameter
        $locale = $request->input('locale');
        if ($locale) {
            $validLocales = ['en', 'ru', 'ee', 'lv', 'lt'];
            if (in_array($locale, $validLocales)) {
                app()->setLocale($locale);
                session()->put('locale', $locale);
            }
        }

        $campaign_title = $request->input('campaign_title');
        $detail = $request->input('detail');
        $payee = $request->input('payee');
        $iban = rawurlencode($request->input('iban'));
        $pp = rawurlencode($request->input('pp'));
        $db = rawurlencode($request->input('db'));
        $sebuid = rawurlencode($request->input('sebuid'));
        $sebuid_st = rawurlencode($request->input('sebuid_st')); // SEB standing orders
        $rev = rawurlencode($request->input('rev'));
        $tax = rawurlencode($request->boolean('tax'));
        $swt = rawurlencode($request->boolean('swt')); // Swed turn off
        $lhvt = rawurlencode($request->boolean('lhvt')); // LHV turn off
        $coopt = rawurlencode($request->boolean('coopt')); // Coop turn off
        $pphb = rawurlencode($request->input('pphb')); // Paypal Hosted Button
        // Stripe payment link id
        $strp = rawurlencode($request->input('strp'));
        $paypalClientId = rawurlencode($request->input('paypalClientId')); // Paypal Hosted Button

        // Use directly without rawurlencode for internal logic
        $onetime = $request->has('onetime') ? filter_var($request->input('onetime'), FILTER_VALIDATE_BOOLEAN) : true;
        $recurring = $request->has('recurring') ? filter_var($request->input('recurring'), FILTER_VALIDATE_BOOLEAN) : true;

        // custom sums
        $defsum = 5;
        $s1 = rawurlencode($request->input('s1'));
        $s2 = rawurlencode($request->input('s2'));
        $s3 = rawurlencode($request->input('s3'));

        // a fixed amount expected from the donor
        // then all preamounts are disabled
        $s0 = rawurlencode($request->input('s0'));

        // links
        $link = url()->full();
        $embedlink = str_replace("/donation", "/embed", $link);

        $amount = null;
        $ik = null;

        $compactData = array(
            'campaign_title',
            'detail',
            'payee',
            'amount',
            'ik',
            'embedlink',
            'link',
            'defsum'
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

        if (isset($strp)) {
            $compactData['strp'] = 'strp';
        }

        if (isset($paypalClientId)) {
            $compactData['paypalClientId'] = 'paypalClientId';
        }

        if (isset($paypalClientId)) {
            $compactData['paypalClientId'] = 'paypalClientId';
        }

        if (isset($s1)) {
            $compactData['s1'] = 's1';
        }

        if (isset($s2)) {
            $compactData['s2'] = 's2';
        }

        if (isset($s3)) {
            $compactData['s3'] = 's3';
        }

        if (isset($s0)) {
            $compactData['s0'] = 's0';
        }

        if (isset($onetime)) {
            $compactData['onetime'] = 'onetime';
        }

        if (isset($recurring)) {
            $compactData['recurring'] = 'recurring';
        }

        return view("cashier", compact($compactData));
    }

    public function getCashierQR(Request $request) {
        $request->validate([
//            'campaign_title' => 'required|string|max:250',
            'detail' => 'required|string|max:250',
            'payee' => 'required|string|max:250',
        ]);

        // Handle locale parameter
        $locale = $request->input('locale');
        if ($locale) {
            $validLocales = ['en', 'ru', 'ee', 'lv', 'lt'];
            if (in_array($locale, $validLocales)) {
                app()->setLocale($locale);
                session()->put('locale', $locale);
            }
        }

        $campaign_title = rawurlencode($request->input('campaign_title'));
        $detail = rawurlencode($request->input('detail'));
        $payee = rawurlencode($request->input('payee'));
        $iban = rawurlencode($request->input('iban'));
        $pp = rawurlencode($request->input('pp'));
        $db = rawurlencode($request->input('db'));
        $sebuid = rawurlencode($request->input('sebuid'));
        $sebuid_st = rawurlencode($request->input('sebuid_st'));
        $rev = rawurlencode($request->input('rev'));
        $amount = rawurlencode($request->input('s0'));
        $ik = " " . rawurlencode($request->input('taxik'));
        // paypal hosted button
        $pphb = rawurlencode($request->input('pphb'));
        // Stripe payment link id
        $strp = rawurlencode($request->input('strp'));
        $paypalClientId = rawurlencode($request->input('paypalClientId')); // Paypal Hosted Button

        // Use directly without rawurlencode for internal logic
        $onetime = $request->has('onetime') ? filter_var($request->input('onetime'), FILTER_VALIDATE_BOOLEAN) : true;
        $recurring = $request->has('recurring') ? filter_var($request->input('recurring'), FILTER_VALIDATE_BOOLEAN) : true;

        if ($request->input('action') == 'cashier') {
            $fullLink = url()->full();
            $link = str_replace("/plink?", "/donation?", $fullLink);
            $cashierLink = str_replace("/plink?", "/cashier?", $fullLink);

            $qrcode = QrCode::format('svg')
                ->size(250)
                ->generate($link);
        }

        $compactData = array(
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
            'strp',
            'paypalClientId',
            'onetime',
            'recurring',

            'qrcode',
            'link',
            'cashierLink'
        );

        $data = array(
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
            'paypalClientId' => $paypalClientId,
            'onetime' => $onetime,
            'recurring' => $recurring,
            'strp' => $strp,

            'qrcode' => $qrcode,
            'link' => $link,
            'cashierLink' => $cashierLink,
        );

        return view("plink", compact($compactData));
    }

    // Generate PDF
    public function createPDF(Request $request)
    {

    }
}
