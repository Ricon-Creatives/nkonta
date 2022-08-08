<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'admin','middleware' => ['auth','twofactor','can:view']], function () {

Route::get('/dashboard', function () {
    return view('admin.layouts.index');
})->name('dashboard');

Route::resource('industry', 'Admin\Account\IndustryController');
Route::resource('account', 'Admin\Account\AccountController');
Route::resource('transactions', 'Admin\Report\TransactionController');
Route::resource('user', 'Admin\User\UserController');
Route::resource('role', 'Admin\Tools\RoleController');
Route::resource('trade', 'Admin\Report\TradeController');
Route::resource('company', 'Admin\User\CompanyController');

//
Route::put('/user/account/status/{id}', 'Admin\User\UnlockUsuerController@__invoke')->name('account.status');
//
Route::post('/industry/account/remove/{id}', 'Admin\Account\IndustryController@remove')->name('account.remove');

//
Route::get('file-import-export', 'Admin\Account\ExportImportController@fileImportExport')->name('file-import-export');
Route::post('file-import', 'Admin\Account\ExportImportController@fileImport')->name('file-import');
Route::get('file-export', 'Admin\Account\ExportImportController@fileExport')->name('file-export');

})

?>
