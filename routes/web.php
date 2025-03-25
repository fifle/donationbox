<?php

use App\Http\Middleware\StripEmptyParams;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Bank redirect links
Route::group(["middleware" => ["web", StripEmptyParams::class]], function () {
    Route::get("/redirect", [
        "as" => "redirect",
        "uses" => "App\Http\Controllers\RedirectController@getBankLink",
    ]);

    Route::post("/redirect/confirm", [
        "as" => "redirect.confirm",
        "uses" => "App\Http\Controllers\RedirectController@confirmRedirect",
    ]);
});

Route::middleware(["web", StripEmptyParams::class, "frame.headers"])->group(
    function () {
        // Homepage
        Route::get("/", function () {
            return view("welcome");
        });

        // Language switcher
        Route::get("lang/{locale}", [
            App\Http\Controllers\LocalizationController::class,
            "index",
        ])->name('lang');

        // Default donation page
        Route::get(
            "/donation",
            "App\Http\Controllers\DonationController@donationLink"
        )
            ->name("donation")
            ->middleware(StripEmptyParams::class);
        Route::post(
            "/donation",
            "App\Http\Controllers\DonationController@donationLink"
        )
            ->name("donation.show")
            ->middleware(StripEmptyParams::class);

        // Widgets
        Route::get(
            "/embed",
            "App\Http\Controllers\DonationController@donationEmbed"
        )
            ->name("donationembed")
            ->middleware(StripEmptyParams::class);
        Route::post(
            "/embed",
            "App\Http\Controllers\DonationController@donationEmbed"
        )
            ->name("donationembed.show")
            ->middleware(StripEmptyParams::class);

        // Cashier mode
        Route::get(
            "/cashier",
            "App\Http\Controllers\DonationController@cashier"
        )
            ->name("cashier")
            ->middleware(StripEmptyParams::class);
        Route::post(
            "/cashier",
            "App\Http\Controllers\DonationController@cashier"
        )
            ->name("cashier.show")
            ->middleware(StripEmptyParams::class);

        // Cashier mode redirect to payment QR code and link details
        Route::get(
            "/plink",
            "App\Http\Controllers\DonationController@getCashierQR"
        )
            ->name("plink")
            ->middleware(StripEmptyParams::class);
        Route::post(
            "/plink",
            "App\Http\Controllers\DonationController@getCashierQR"
        )
            ->name("plink.show")
            ->middleware(StripEmptyParams::class);

        // QR PNG generator
        Route::get("/qrpng", "App\Http\Controllers\QRController@generatePNG")
            ->name("qrpng")
            ->middleware(StripEmptyParams::class);
        Route::post("/qrpng", "App\Http\Controllers\QRController@generatePNG")
            ->name("qrpng.show")
            ->middleware(StripEmptyParams::class);

        // QR PNG generator
        Route::get("/qrsvg", "App\Http\Controllers\QRController@generateSVG")
            ->name("qrsvg")
            ->middleware(StripEmptyParams::class);
        Route::post("/qrsvg", "App\Http\Controllers\QRController@generateSVG")
            ->name("qrsvg.show")
            ->middleware(StripEmptyParams::class);

        // TODO: PDF generator
        Route::get("/pdf", "App\Http\Controllers\DonationController@createPDF")
            ->name("pdf")
            ->middleware(StripEmptyParams::class);
        Route::post("/pdf", "App\Http\Controllers\DonationController@createPDF")
            ->name("pdf.show")
            ->middleware(StripEmptyParams::class);

        // About/FAQ page
        Route::get("/about", function () {
            return view("pages.about");
        })->middleware(StripEmptyParams::class);

        /*
         * Custom redirects for our partners.
         */
        if (env("COUNTRY") == "ee") {
            // MTÜ Helihool
            Route::get("/mariupolsfriends", function () {
                $url =
                    "//donationbox.ee/donation/?iban=EE534204278619625400&campaign_title=Help+for+Ukrainian+refugees+in+Estonia+%2F+abi+Ukraina+pagulastele+Eestis&payee=" .
                    rawurlencode("Mittetulundusühing") .
                    "+Mariupoli+Sõbrad&detail=Help+for+Ukrainian+refugees+%2F+abi+Ukraina+pagulastele&db=mariupoli-sobrad&sebuid=7f741bb6-ecb3-4c39-a661-513fe1229fe1&sebuid_st=2fd9407d-b827-4b5b-aae7-9889d5facc74&s1=25&s2=50&s3=100";
                return Redirect::to($url);
            });
        }

        if (env("COUNTRY") == "lv") {
            // MTÜ Helihool
            Route::get("/jewnited", function () {
                $url =
                    "//donationbox.lv/donation?campaign_title=Support+Jewnited.lv&detail=Ziedojums&payee=JEWNITED.LV&iban=LV05RIKO0002930376514&paypalClientId=AfwBKcbnuAWT79QQOzYfGGwVZGtH2b8EmgHHoY6vms-EZbVfTmTSDxP6blH8KqowZLsoqg4IlbJ2w-7L&sebuid=7b9882e8-a727-4ca0-8e1c-87825aad67ff&sebuid_st=361c6c70-036a-4da5-aced-751817f27762&s1=25&s2=50&s3=100";
                return Redirect::to($url);
            });
        }
    }
);
