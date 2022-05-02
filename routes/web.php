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
require 'admin.php';

Route::get('/', function () {
    return view('welcome');
});

//Route::resource('verify', 'Auth\TwoFactorController')->only(['index', 'store']);

Route::group(['middleware' => ['auth','twofactor']], function () {

Route::get('/verify-code','Auth2\TwoFactorController@index')->name('verify.index');
Route::post('/verify-code','Auth2\TwoFactorController@store')->name('verify.send');
Route::get('verify/resend', 'Auth2\TwoFactorController@resend')->name('verify.resend');

Route::get('/home', function () {
    return view('dashboard.home');
})->name('home');

Route::get('/income-statement','Reports\ProfitLossController@index')->name('profit-loss');

Route::get('/transactions','Reports\TransactionsController@index')->name('transactions');

Route::post('/transaction','Reports\TransactionsController@store')->name('add.transaction');

Route::get('/trial-summary','Reports\TrialSummaryController@index')->name('summary');
Route::get('/balance-sheet','Reports\TotalController@index')->name('bal-sheet');

Route::get('/reports', 'Reports\ReportController@index')->name('reports');

//DownloadPDF
Route::get('/download/balance-sheet-pdf','Documents\DownloadPDFController@downloadBalSheetPdf')->name('download-pdf');
Route::get('/download/profit-loss-pdf','Documents\DownloadPDFController@downloadPLPdf')->name('download-profitloss-pdf');
Route::get('/download/trial-balance-pdf','Documents\DownloadPDFController@downloadTrialBalPdf')->name('download-trial-balance-pdf');


});

require __DIR__.'/auth.php';
