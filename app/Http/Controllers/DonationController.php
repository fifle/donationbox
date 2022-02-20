<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DonationController extends Controller
{
    public function donationLink(Request $request)
    {
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

            // links
//            $link = url('/donation?campaign_title=' . $campaign_title . '&detail=' . $detail . '&payee=' . $payee . '&iban=' . $iban . '&pp=' . $pp . '');

            $link = sprintf(url('/donation?campaign_title=%s&detail=%s&payee=%s&iban=%s&pp=%s&db=%s&sebuid=%s'),
                $campaign_title, $detail, $payee, $iban, $pp, $db, $sebuid);

            // swedbank
            $amount = null;

//            echo $link;
//            echo '<br>';
//            echo urldecode($link);

            $qrcode = QrCode::size(250)
                ->color(150, 90, 10)
                ->generate($link);

            // passing values to the session
            session(array(
                    'campaign_title' => $campaign_title,
                    'detail' => $detail,
                    'payee' => $payee,
                    'iban' => $iban,
                    'pp' => $pp,
                    'db' => $db,
                    'sebuid' => $sebuid,
                )
            );

            $compactData = array(
                'qrcode',
                'campaign_title',
                'detail',
                'payee',
                'iban',
                'pp',
                'db',
                'sebuid',
                'amount',
            );

            $data = array(
                'qrcode' => $qrcode,
                'campaign_title' => $campaign_title,
                'detail' => $detail,
                'payee' => $payee,
                'iban' => $iban,
                'pp' => $pp,
                'db' => $db,
                'sebuid' => $sebuid,
                'amount' => $amount,
            );

            return view("donation", compact($compactData));
        }
    }
}
