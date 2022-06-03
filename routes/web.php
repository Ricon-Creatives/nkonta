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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pricing', function () {
    return view('pricing');
});

//Route::resource('verify', 'Auth\TwoFactorController')->only(['index', 'store']);
require 'admin.php';

Route::group(['middleware' => ['auth','twofactor']], function () {

Route::get('/verify-code','Auth2\TwoFactorController@index')->name('verify.index');
Route::post('/verify-code/check','Auth2\TwoFactorController@store')->name('verify.send');
Route::get('verify/resend', 'Auth2\TwoFactorController@resend')->name('verify.resend');

Route::get('/home','Dashboard\DashboardController@income')->name('home');

Route::get('/income-statement','Reports\ProfitLossController@index')->name('profit-loss');

Route::get('/transactions','Reports\TransactionsController@index')->name('transactions');

Route::post('/transaction','Reports\TransactionsController@store')->name('add.transaction');

Route::get('/trial-summary','Reports\TrialSummaryController@index')->name('summary');
Route::get('/balance-sheet','Reports\TotalController@index')->name('bal-sheet');

//
Route::get('/reports/revenues', 'Reports\ReportController@revenue')->name('reports.revenue');
Route::get('/reports/expenses', 'Reports\ReportController@expenses')->name('reports.expenses');
Route::get('/reports/tax', 'Reports\ReportController@tax')->name('reports.tax');

//Title
Route::get('/create/new','Reports\TitleController@create')->name('create.title');
Route::post('/create/new','Reports\TitleController@store')->name('new.title');

//
Route::resource('purchases', 'Purchases\PurchasesController');
Route::resource('sales', 'Sales\SalesController');
//Item
Route::get('/create/item', 'Reports\ItemController@create')->name('item.create');
Route::post('/item/new','Reports\ItemController@store')->name('item.store');


//
Route::get('/estimate/{id}', 'Documents\GenerateFileController@estimate')->name('show.estimate');

//DownloadPDF
Route::get('/download/balance-sheet-pdf','Documents\DownloadPDFController@downloadBalSheetPdf')->name('download-pdf');
Route::get('/download/profit-loss-pdf','Documents\DownloadPDFController@downloadPLPdf')->name('download-profitloss-pdf');
Route::get('/download/trial-balance-pdf','Documents\DownloadPDFController@downloadTrialBalPdf')->name('download-trial-balance-pdf');

//CSV
Route::get('/export/csv','Documents\ExportCSVController@export')->name('export.csv');

//Search
Route::get('/search/reports/revenue','Search\SearchReportController@revenueFilter')->name('search.revenue');
Route::get('/search/reports/expense','Search\SearchReportController@expenseFilter')->name('search.expense');
Route::get('/search/reports/tax','Search\SearchReportController@taxFilter')->name('search.tax');
Route::get('/search/reports/trial-summary','Search\SearchReportController@trialSummaryFilter')->name('search.trialSummary');
Route::get('/search/reports/balance-sheet','Search\SearchReportController@balSheetFilter')->name('search.balance-sheet');
Route::get('/search/reports/profit-loss','Search\SearchReportController@profitLossFilter')->name('search.profit-loss');
Route::get('/search/transactions','Search\SearchReportController@transactionsFilter')->name('search.transaction');
Route::get('/search/sales','Search\SearchReportController@sales')->name('search.sales');
Route::get('/search/purchases','Search\SearchReportController@purchases')->name('search.purchases');



});

require __DIR__.'/auth.php';
