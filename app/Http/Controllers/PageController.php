<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function getAbout() {
        return view('pages/about');
    }
}
