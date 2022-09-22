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
Route::get('/about', function () {
    return view('about');
});


//Route::resource('verify', 'Auth\TwoFactorController')->only(['index', 'store']);
require 'admin.php';

Route::group(['middleware' => ['auth','twofactor']], function () {
//
Route::get('/verify-code','Auth2\TwoFactorController@index')->name('verify.index');
Route::post('/verify-code/check','Auth2\TwoFactorController@store')->name('verify.send');
Route::get('verify/resend', 'Auth2\TwoFactorController@resend')->name('verify.resend');
//
Route::get('/home','Dashboard\DashboardController@index')->name('home');
Route::get('/income/home','Dashboard\DashboardController@income');
Route::get('/cash/home','Dashboard\DashboardController@cash');


Route::get('/income-statement','Reports\ProfitLossController@index')->name('profit-loss');

Route::resource('transaction', 'Reports\TransactionsController');

Route::get('/trial-summary','Reports\TrialSummaryController@index')->name('summary');
Route::get('/balance-sheet','Reports\TotalController@index')->name('bal-sheet');

//Reports
Route::get('/revenues', 'Reports\ReportController@revenue')->name('reports.revenue');
Route::get('/expenses', 'Reports\ReportController@expenses')->name('reports.expenses');
Route::get('/tax-reports', 'Reports\ReportController@tax')->name('reports.tax');
//Title
Route::get('/create/new','Reports\TitleController@create')->name('create.title');
Route::post('/create/new','Reports\TitleController@store')->name('new.title');
//Sales & Purchases
Route::resource('purchases', 'Purchases\PurchasesController');
Route::resource('sales', 'Sales\SalesController');
//Item
Route::get('/create/item', 'Reports\ItemController@create')->name('item.create');
Route::post('/item/new','Reports\ItemController@store')->name('item.store');
//
Route::get('/estimate/{id}', 'Documents\GenerateFileController@estimate')->name('show.estimate');
//User
Route::get('/profile', 'User\UserController@editProfile')->name('profile');
Route::get('/profile/account/change-password', 'User\UserController@editPassword')->name('profile.password');
Route::get('/profile/my-business/', 'User\CompanyController@edit')->name('my-business');
Route::patch('/profile/account/update', 'User\UserController@update')->name('account.update');
Route::patch('/profile/account/update-password', 'User\UserController@updatePassword')->name('profile.password.update');
Route::patch('/profile/my-business/update', 'User\CompanyController@update')->name('my-business.update');

//
Route::resource('reconcilation', 'Reports\ReconcileController');
//
Route::resource('employee', 'User\EmployeeController');
Route::resource('invites', 'User\InviteController');
Route::get('/invite/accept/{token}', 'User\InviteController@accept')->name('invite.accept');
//
Route::resource('company-accounts', 'Account\CompanyAccountsController');
Route::get('company-accounts/accounts', 'Account\CompanyAccountsController@account');
//Route::delete('company-accounts/accounts/{id}', 'Account\CompanyAccountsController@destroy');
Route::post('company-accounts/account', 'Account\CompanyAccountsController@store');

//
Route::resource('payroll', 'Reports\PayrollController');
//
Route::get('/payroll/submit/transactions', 'Reports\SubmitTransactionController@submit')->name('payroll.submit');
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
Route::get('/search/payroll','Search\SearchReportController@purchases')->name('search.payroll');


});

require __DIR__.'/auth.php';
