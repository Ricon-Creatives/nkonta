<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('admin.layouts.index');
})->name('dashboard');

Route::get('/admin/dashboard/accounts', 'Admin\Account\AccountsController@index')->name('accounts');
Route::get('/account/new', 'Admin\Account\AccountsController@create')->name('account.create');
Route::post('/account/new', 'Admin\Account\AccountsController@store')->name('account.add');
Route::delete('/account/{id}', 'Admin\Account\AccountsController@destroy')->name('account.delete');

//
Route::get('file-import-export', 'Admin\Account\ExportImportController@fileImportExport')->name('file-import-export');
Route::post('file-import', 'Admin\Account\ExportImportController@fileImport')->name('file-import');
Route::get('file-export', 'Admin\Account\ExportImportController@fileExport')->name('file-export');

?>
