<?php

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

Route::get('/donation', 'App\Http\Controllers\DonationController@donationLink')->name('donation');
Route::post('/donation', 'App\Http\Controllers\DonationController@donationLink')->name('donation.show');

Route::get('/embed', 'App\Http\Controllers\DonationController@donationEmbed')->name('donationembed');
Route::post('/embed', 'App\Http\Controllers\DonationController@donationEmbed')->name('donationembed.show');

Route::get('/redirect', 'App\Http\Controllers\RedirectController@getBankLink')->name('redirect');
Route::post('/redirect', 'App\Http\Controllers\RedirectController@getBankLink')->name('redirect.show');

Route::get('/pdf', 'App\Http\Controllers\DonationController@createPDF')->name('pdf');
Route::post('/pdf', 'App\Http\Controllers\DonationController@createPDF')->name('pdf.show');

Route::view('/about', 'about');
