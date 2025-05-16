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

// Homepage
Route::get('/', function () {
    return view('welcome');
});

// Language switcher
Route::get('lang/{locale}', [App\Http\Controllers\LocalizationController::class, 'index'])->name('lang');

// Default donation page
Route::get('/donation', 'App\Http\Controllers\DonationController@donationLink')->name('donation')->middleware(StripEmptyParams::class);
Route::post('/donation', 'App\Http\Controllers\DonationController@donationLink')->name('donation.show')->middleware(StripEmptyParams::class);

// Widgets - POST route defined here, GET route defined conditionally below
Route::post('/embed', 'App\Http\Controllers\DonationController@donationEmbed')->name('donationembed.show')->middleware(StripEmptyParams::class);

// Cashier mode
Route::get('/cashier', 'App\Http\Controllers\DonationController@cashier')->name('cashier')->middleware(StripEmptyParams::class);
Route::post('/cashier', 'App\Http\Controllers\DonationController@cashier')->name('cashier.show')->middleware(StripEmptyParams::class);

// Bank redirect links
Route::get('/redirect', 'App\Http\Controllers\RedirectController@getBankLink')->name('redirect')->middleware(StripEmptyParams::class);
Route::post('/redirect', 'App\Http\Controllers\RedirectController@getBankLink')->name('redirect.show')->middleware(StripEmptyParams::class);

// Cashier mode redirect to payment QR code and link details
Route::get('/plink', 'App\Http\Controllers\DonationController@getCashierQR')->name('plink')->middleware(StripEmptyParams::class);
Route::post('/plink', 'App\Http\Controllers\DonationController@getCashierQR')->name('plink.show')->middleware(StripEmptyParams::class);

// QR PNG generator
Route::get('/qrpng', 'App\Http\Controllers\QRController@generatePNG')->name('qrpng')->middleware(StripEmptyParams::class);
Route::post('/qrpng', 'App\Http\Controllers\QRController@generatePNG')->name('qrpng.show')->middleware(StripEmptyParams::class);

// QR PNG generator
Route::get('/qrsvg', 'App\Http\Controllers\QRController@generateSVG')->name('qrsvg')->middleware(StripEmptyParams::class);
Route::post('/qrsvg', 'App\Http\Controllers\QRController@generateSVG')->name('qrsvg.show')->middleware(StripEmptyParams::class);

// TODO: PDF generator
Route::get('/pdf', 'App\Http\Controllers\DonationController@createPDF')->name('pdf')->middleware(StripEmptyParams::class);
Route::post('/pdf', 'App\Http\Controllers\DonationController@createPDF')->name('pdf.show')->middleware(StripEmptyParams::class);

// About/FAQ page
Route::get('/about', function () {return view('pages.about');})->middleware(StripEmptyParams::class);

/*
 * Custom redirects for our partners.
 */
if (env('COUNTRY') == 'ee') {
    // MTÜ Helihool
    Route::get('/mariupolsfriends', function () {
        $url ='//donationbox.ee/donation/?iban=EE534204278619625400&campaign_title=Help+for+Ukrainian+refugees+in+Estonia+%2F+abi+Ukraina+pagulastele+Eestis&payee=' . rawurlencode("Mittetulundusühing") . '+Mariupoli+Sõbrad&detail=Help+for+Ukrainian+refugees+%2F+abi+Ukraina+pagulastele&db=mariupoli-sobrad&sebuid=7f741bb6-ecb3-4c39-a661-513fe1229fe1&sebuid_st=2fd9407d-b827-4b5b-aae7-9889d5facc74&s1=25&s2=50&s3=100';
        return Redirect::to($url);
    });

    // GET route for embed with Pühtitsa monastery redirect check
    Route::get('/embed', function () {
        // Check if this is the specific Pühtitsa monastery URL
        $campaignTitle = request()->input('campaign_title');
        $detail = request()->input('detail');
        $payee = request()->input('payee');
        $sebuid = request()->input('sebuid');
        $sebuid_st = request()->input('sebuid_st');

        // Only redirect if all these parameters match the Pühtitsa monastery donation
        if ($campaignTitle === 'СБОР ПОЖЕРТВОВАНИЙ на юридическую помощь для Пюхтицкого монастыря' &&
            $detail === 'Annetus õigusabikulude tasumiseks' &&
            $payee === 'Pühtitsa Jumalaema Uinumise Stavropigiaalne Naisklooster' &&
            $sebuid === 'e3a869fc-599f-47ea-bd46-e77a8a3ab2b5' &&
            $sebuid_st === 'd3ea5837-2b3f-4a4a-8f0d-48c2b8e9385a' &&
            !request()->has('iban')) {

            // Add the IBAN parameter to the current URL
            $currentUrl = request()->fullUrl();
            $redirectUrl = $currentUrl . '&iban=EE812200221087546816';

            return Redirect::to($redirectUrl);
        }

        // Continue normal processing for all other embed URLs
        return app()->call('App\Http\Controllers\DonationController@donationEmbed');
    })->name('donationembed')->middleware(StripEmptyParams::class);
} else {
    // Standard embed route for non-EE countries
    Route::get('/embed', 'App\Http\Controllers\DonationController@donationEmbed')
        ->name('donationembed')
        ->middleware(StripEmptyParams::class);
}

if (env('COUNTRY') == 'lv') {
    // Jewnited.lv
    Route::get('/jewnited', function () {
        $url ='//donationbox.lv/donation?campaign_title=Support+Jewnited.lv&detail=Ziedojums&payee=JEWNITED.LV&iban=LV05RIKO0002930376514&paypalClientId=AfwBKcbnuAWT79QQOzYfGGwVZGtH2b8EmgHHoY6vms-EZbVfTmTSDxP6blH8KqowZLsoqg4IlbJ2w-7L&sebuid=7b9882e8-a727-4ca0-8e1c-87825aad67ff&sebuid_st=361c6c70-036a-4da5-aced-751817f27762&s1=25&s2=50&s3=100';
        return Redirect::to($url);
    });

    // Chabad.lv
    Route::get('/chabad', function () {
        $url ='//donationbox.lv/donation?campaign_title=Support%20Chabad%20of%20Latvia&detail=Ziedojums&iban=LV81PARX0001041501018&payee=Habad%20Lubavic%20Draudze&sebuid=4b663218-c93e-4c21-8855-a0396534f14c&sebuid_st=08311845-996c-42d3-ad3c-2f024deb31bf&strp=8x26oH0gvaX66GNfALeAg00&s1=25&s2=50&s3=100';
        return Redirect::to($url);
    });
}


