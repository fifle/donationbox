<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Jorenvh\Share\Share;
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

            // links
            $link = sprintf(url('/donation?campaign_title=%s&detail=%s&payee=%s&iban=%s&pp=%s&db=%s&sebuid=%s'),
                $campaign_title, $detail, $payee, $iban, $pp, $db, $sebuid);
            $embedlink = sprintf(url('/embed?campaign_title=%s&detail=%s&payee=%s&iban=%s&pp=%s&db=%s&sebuid=%s'),
                $campaign_title, $detail, $payee, $iban, $pp, $db, $sebuid);

            // swedbank
            $amount = null;

            // QR-code generation
            $qrcode = QrCode::format('png')
                ->merge('img/db-logo-qr.png', .3, true)
                ->size(1920)
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
                'embedlink',
                'link',
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
                'embedlink' => $embedlink,
                'link' => $link,
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
            $iban = urlencode($request->input('iban'));
            $pp = urlencode($request->input('pp'));
            $db = urlencode($request->input('db'));
            $sebuid = urlencode($request->input('sebuid'));

            // links
            $link = sprintf(url('/donation?campaign_title=%s&detail=%s&payee=%s&iban=%s&pp=%s&db=%s&sebuid=%s'),
                $campaign_title, $detail, $payee, $iban, $pp, $db, $sebuid);
            $embedlink = sprintf(url('/embed?campaign_title=%s&detail=%s&payee=%s&iban=%s&pp=%s&db=%s&sebuid=%s'),
                $campaign_title, $detail, $payee, $iban, $pp, $db, $sebuid);

            // swedbank
            $amount = null;

            // QR-code generation
            $qrcode = QrCode::format('png')
                ->merge('img/db-logo-qr.png', .3, true)
                ->size(1920)
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
                'embedlink',
                'link',
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
                'embedlink' => $embedlink,
                'link' => $link,
            );

            return view("embed", compact($compactData));
        }
    }

    // Generate PDF
    public function createPDF(Request $request) {

    }
}
