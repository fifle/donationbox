<?php

use App\Http\Middleware\StripEmptyParams;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('welcome');
});

Route::get('/donation', 'App\Http\Controllers\DonationController@donationLink')->name('donation')->middleware(StripEmptyParams::class);;
Route::post('/donation', 'App\Http\Controllers\DonationController@donationLink')->name('donation.show')->middleware(StripEmptyParams::class);;

Route::get('/embed', 'App\Http\Controllers\DonationController@donationEmbed')->name('donationembed');
Route::post('/embed', 'App\Http\Controllers\DonationController@donationEmbed')->name('donationembed.show');

Route::get('/redirect', 'App\Http\Controllers\RedirectController@getBankLink')->name('redirect');
Route::post('/redirect', 'App\Http\Controllers\RedirectController@getBankLink')->name('redirect.show');

Route::get('/pdf', 'App\Http\Controllers\DonationController@createPDF')->name('pdf');
Route::post('/pdf', 'App\Http\Controllers\DonationController@createPDF')->name('pdf.show');

Route::get('/about', function () {return view('pages.about');});

/**
 * Custom redirects for our partners.
 */
if (env('COUNTRY') == 'ee') {
    // MTÜ Helihool
    Route::get('/mariupolsfriends', function () {
        $url = urldecode('/donation/?iban=EE534204278619625400&campaign_title=Help+for+Ukrainian+refugees+in+Estonia+%2F+abi+Ukraina+pagulastele+Eestis&payee=Mittetulundusühing+Helihool&detail=Help+for+Ukrainian+refugees+%2F+abi+Ukraina+pagulastele&pphb=GYBURV4YX4KLY');
        return redirect($url);
    });
}
