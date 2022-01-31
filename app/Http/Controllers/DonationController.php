<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DonationController extends Controller
{
    public function donationLink(Request $request) {
        if(!$request->has('campaign_title')) {
            return redirect()->route('welcome');
        } else {
            $campaign_title = urlencode($request->input('campaign_title'));
            $detail = urlencode($request->input('detail'));
            $payee = urlencode($request->input('payee'));
            $iban = urlencode($request->input('iban'));
            $pp = urlencode($request->input('pp'));

            // links
            $link = url('/donation?campaign_title=' . $campaign_title . '&detail=' . $detail . '&payee=' .
                $payee . '&iban=' . $iban . '&pp=' . $pp . '');

            // swedbank
            $amount = null;
            $swed_single = sprintf("https://www.swedbank.ee/private/d2d/payments2/domestic/new?domestic.beneficiaryAccountNumber=%s&domestic.beneficiaryName=%s&domestic.details=%s&domestic.amount=", urldecode($iban), urldecode($payee), urldecode($detail));

            echo $link;
            echo '<br>';
            echo urldecode($link);

            $qrcode = QrCode::size(200)->generate($link);

            $compactData=array(
                'qrcode',
                'campaign_title',
                'detail' ,
                'payee',
                'iban',
                'pp',
                'amount',
                'swed_single'
            );

            $data = array(
                'qrcode' => $qrcode,
                'campaign_title' => $campaign_title,
                'detail' => $detail,
                'payee' => $payee,
                'iban' => $iban,
                'pp' => $pp,
                'amount' => $amount,
                'swed_single' => $swed_single
            );

            return view("donation", compact($compactData)   );
        }
    }

    public function getBankLink(Request $request) {
        switch ($request->input('donationsum')) {
            case 'swedbank':
                $amount = urlencode($request->input('donationsum'));

                $url = "https://www.swedbank.ee/private/d2d/payments2/domestic/new?domestic
                #.beneficiaryAccountNumber=%s&domestic.beneficiaryName=%s&domestic.details=%s&domestic.amount=";
                break;
        }

        $compactData=array(
            'url'
        );

        $data = array(
            'url' => $url
        );

        return view("banklink", compact($compactData));
    }
}
