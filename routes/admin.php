<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'admin','middleware' => ['auth','twofactor']], function () {

Route::get('/dashboard', function () {
    return view('admin.layouts.index');
})->name('dashboard');

Route::get('/dashboard/accounts', 'Admin\Account\AccountController@index')->name('accounts');

/*
Route::get('/account/new', 'Admin\Account\AccountController@create')->name('account.create');
Route::post('/account/new', 'Admin\Account\AccountController@store')->name('account.add');
Route::delete('/account/{id}', 'Admin\Account\AccountController@destroy')->name('account.delete');
*/
Route::resource('account', 'Admin\Account\AccountController');

//
Route::get('file-import-export', 'Admin\Account\ExportImportController@fileImportExport')->name('file-import-export');
Route::post('file-import', 'Admin\Account\ExportImportController@fileImport')->name('file-import');
Route::get('file-export', 'Admin\Account\ExportImportController@fileExport')->name('file-export');

})

?>
