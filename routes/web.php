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

Route::get('/', function () {
    return view('welcome');
});

Route::get('lang/{locale}', [App\Http\Controllers\LocalizationController::class, 'index']);

Route::get('/donation', 'App\Http\Controllers\DonationController@donationLink')->name('donation')->middleware(StripEmptyParams::class);
Route::post('/donation', 'App\Http\Controllers\DonationController@donationLink')->name('donation.show')->middleware(StripEmptyParams::class);

Route::get('/embed', 'App\Http\Controllers\DonationController@donationEmbed')->name('donationembed')->middleware(StripEmptyParams::class);
Route::post('/embed', 'App\Http\Controllers\DonationController@donationEmbed')->name('donationembed.show')->middleware(StripEmptyParams::class);

Route::get('/redirect', 'App\Http\Controllers\RedirectController@getBankLink')->name('redirect')->middleware(StripEmptyParams::class);
Route::post('/redirect', 'App\Http\Controllers\RedirectController@getBankLink')->name('redirect.show')->middleware(StripEmptyParams::class);

// QR PNG generator
Route::get('/qrpng', 'App\Http\Controllers\QRController@generatePNG')->name('qrpng')->middleware(StripEmptyParams::class);
Route::post('/qrpng', 'App\Http\Controllers\QRController@generatePNG')->name('qrpng.show')->middleware(StripEmptyParams::class);

// QR PNG generator
Route::get('/qrsvg', 'App\Http\Controllers\QRController@generateSVG')->name('qrsvg')->middleware(StripEmptyParams::class);
Route::post('/qrsvg', 'App\Http\Controllers\QRController@generateSVG')->name('qrsvg.show')->middleware(StripEmptyParams::class);

Route::get('/pdf', 'App\Http\Controllers\DonationController@createPDF')->name('pdf')->middleware(StripEmptyParams::class);
Route::post('/pdf', 'App\Http\Controllers\DonationController@createPDF')->name('pdf.show')->middleware(StripEmptyParams::class);

Route::get('/about', function () {return view('pages.about');})->middleware(StripEmptyParams::class);

/*
 * Custom redirects for our partners.
 */
if (env('COUNTRY') == 'ee') {
    // MTÜ Helihool
    Route::get('/mariupolsfriends', function () {
        $url ='//donationbox.ee/donation/?iban=EE534204278619625400&campaign_title=Help+for+Ukrainian+refugees+in+Estonia+%2F+abi+Ukraina+pagulastele+Eestis&payee=' . rawurlencode("Mittetulundusühing") . '+Helihool&detail=Help+for+Ukrainian+refugees+%2F+abi+Ukraina+pagulastele&pphb=GYBURV4YX4KLY';
        return Redirect::to($url);
    });
}
