<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'admin','middleware' => ['auth','twofactor']], function () {

Route::get('/dashboard', function () {
    return view('admin.layouts.index');
})->name('dashboard');

Route::resource('account', 'Admin\Account\AccountController');
Route::resource('transaction', 'Admin\Report\TransactionController');
Route::resource('user', 'Admin\User\UserController');
Route::resource('role', 'Admin\Tools\RoleController');
//
Route::put('/user/account/status/{id}', 'Admin\User\UnlockUsuerController@__invoke')->name('account.status');

//
Route::get('file-import-export', 'Admin\Account\ExportImportController@fileImportExport')->name('file-import-export');
Route::post('file-import', 'Admin\Account\ExportImportController@fileImport')->name('file-import');
Route::get('file-export', 'Admin\Account\ExportImportController@fileExport')->name('file-export');

})

?>
