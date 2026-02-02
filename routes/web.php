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

// Edit existing donationbox link
Route::get('/edit', 'App\Http\Controllers\DonationController@editLink')->name('edit');

// Language switcher
Route::get('lang/{locale}', [App\Http\Controllers\LocalizationController::class, 'index'])->name('lang');

// Default donation page - POST route (same for all countries)
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
Route::get('/about', [App\Http\Controllers\AboutController::class, 'show'])->middleware(StripEmptyParams::class);

/*
 * Custom redirects for our partners.
 */
if (env('COUNTRY') == 'ee') {
    // MTÜ Helihool
    Route::get('/mariupolsfriends', function () {
        $url ='//donationbox.ee/donation/?iban=EE534204278619625400&campaign_title=Help+for+Ukrainian+refugees+in+Estonia+%2F+abi+Ukraina+pagulastele+Eestis&payee=' . rawurlencode("Mittetulundusühing") . '+Mariupoli+Sõbrad&detail=Help+for+Ukrainian+refugees+%2F+abi+Ukraina+pagulastele&db=mariupoli-sobrad&sebuid=7f741bb6-ecb3-4c39-a661-513fe1229fe1&sebuid_st=2fd9407d-b827-4b5b-aae7-9889d5facc74&s1=25&s2=50&s3=100';
        return Redirect::to($url);
    });

    // MTÜ Mustvee Heaks
    Route::get('/mtumustveeheaks', function () {
        $url ='//donationbox.ee/embed?campaign_title=%F0%9F%8C%8A%20Teeme%20Mustvee%20ranna%20korda%20-%20koos%21%20%F0%9F%8C%9E&detail=Annetus&iban=EE792200221093278097&payee=MT%C3%9C%20Mustvee%20Heaks&strp=28EeVf2Bn73A0Qy41We3e02';
        return Redirect::to($url);
    });

    // GET route for donation with Kommijagamise tuur redirect check
    Route::get('/donation', function () {
        // Decode parameters to handle encoding variations
        $campaignTitle = rawurldecode(request()->input('campaign_title', ''));
        $detail = rawurldecode(request()->input('detail', ''));
        $payee = rawurldecode(request()->input('payee', ''));
        $iban = request()->input('iban', '');
        $tax = request()->input('tax', '');

        // Check if this matches the Kommijagamise tuur donation pattern
        // Compare decoded values to handle %20, +, and other encoding variations
        if (strcasecmp($campaignTitle, 'Kommijagamise tuur') === 0 &&
            $detail === 'Annetus' &&
            strcasecmp($payee, 'KOMMIJAGAMISE TUUR MTÜ') === 0 &&
            $iban === 'EE852200221080277564' &&
            $tax === '1' &&
            !request()->has('sebuid')) {

            // Build the redirect URL with the new parameters
            // Pass decoded values and let http_build_query encode them (uses + for spaces by default)
            $redirectUrl = '//donationbox.ee/donation?' . http_build_query([
                'campaign_title' => 'Kommijagamise tuur',
                'detail' => 'Annetus',
                'payee' => 'KOMMIJAGAMISE TUUR MTÜ',
                'tax' => '1',
                'iban' => 'EE852200221080277564',
                'sebuid' => 'dde0f52b-41e3-464d-8b10-ce1e48767065',
                'sebuid_st' => '217366f5-0d53-4d20-80cb-139cecc4cc29'
            ]);

            return Redirect::to($redirectUrl);
        }

        // Continue normal processing for all other donation URLs
        return app()->call('App\Http\Controllers\DonationController@donationLink');
    })->name('donation')->middleware(StripEmptyParams::class);

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
    
    // Standard donation route for non-EE countries
    Route::get('/donation', 'App\Http\Controllers\DonationController@donationLink')->name('donation')->middleware(StripEmptyParams::class);
}

if (env('COUNTRY') == 'lv') {
    // Jewnited.lv
    Route::get('/jewnited', function () {
        $url ='//donationbox.lv/donation?campaign_title=Support+Jewnited.lv&detail=Ziedojums&payee=JEWNITED.LV&iban=LV05RIKO0002930376514&paypalClientId=AfwBKcbnuAWT79QQOzYfGGwVZGtH2b8EmgHHoY6vms-EZbVfTmTSDxP6blH8KqowZLsoqg4IlbJ2w-7L&sebuid=7b9882e8-a727-4ca0-8e1c-87825aad67ff&sebuid_st=361c6c70-036a-4da5-aced-751817f27762&s1=25&s2=50&s3=100';
        return Redirect::to($url);
    });

    // Chabad.lv
    Route::get('/chabad', function () {
        $url ='//donationbox.lv/donation?campaign_title=Support%20Chabad%20of%20Latvia&detail=Ziedojums%20DB&iban=LV81PARX0001041501018&payee=Habad%20Lubavic%20Draudze&sebuid=4b663218-c93e-4c21-8855-a0396534f14c&sebuid_st=08311845-996c-42d3-ad3c-2f024deb31bf&strp=8x26oH0gvaX66GNfALeAg00&s1=25&s2=50&s3=100';
        return Redirect::to($url);
    });

    // Chabad School Riga
    Route::get('/habadskola', function () {
        $url ='//donationbox.lv/donation?campaign_title=Support+Chabad+School+Riga&detail=Ziedojums+Habad+Skola&payee=Habad+Lubavic+Draudze&iban=LV81PARX0001041501018&sebuid=https%3A%2F%2Fibanka.seb.lv%2Fib%2Flogin%3FUID%3D4b663218-c93e-4c21-8855-a0396534f14c&sebuid_st=https%3A%2F%2Fibanka.seb.lv%2Fib%2Flogin%3FUID%3D08311845-996c-42d3-ad3c-2f024deb31bf&strp=8x26oH0gvaX66GNfALeAg00&s1=25&s2=50&s3=100';
        return Redirect::to($url);
    });

    // Kosher Store
    Route::get('/kosherstore', function () {
        $url ='//donationbox.lv/donation?campaign_title=Payment+to+Kosher+Store&detail=Apmaksa+par+pirkumu&payee=IUDAIKA+SIA&iban=LV26PARX0013206990002&sebuid=https%3A%2F%2Fibanka.seb.lv%2Fib%2Flogin%3FUID%3Dfe1da91f-3d8c-4255-9a01-e9a123c40435&sebuid_st=https%3A%2F%2Fibanka.seb.lv%2Fib%2Flogin%3FUID%3D55e7e7fb-e822-46cf-9915-36b1d8239fe8&strp=5kQ14nfhq86BcGI71q1Fe00&s1=25&s2=50&s3=100';
        return Redirect::to($url);
    });
}


