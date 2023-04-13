<?php

namespace App\Http\Controllers;

use http\Url;
use Illuminate\Http\Request;
use Knp\Snappy\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
//    public function generatePNG()
//    {
//        $url = url()->previous();
//
//        $qrcode = QrCode::format('png')
//            ->merge('img/db-logo-qr.png', .3, true)
//            ->size(1920)
//            ->generate($url);
//
//        return $qrcode;
//    }

    public function generateSVG() {
        $url = url()->previous();

        $qrcode = QrCode::generate($url);

        return $qrcode;
    }

    public function generatePDF() {

    }
}
