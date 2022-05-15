<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Imports\AccountsImport;
use App\Exports\AccountsExport;
use Maatwebsite\Excel\Facades\Excel;



class ExportImportController extends Controller
{
    public function fileImportExport()
    {
       return view('admin.accounts.file-import');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileImport(Request $request)
    {
        Excel::import(new AccountsImport, $request->file('file')->store('temp'));
        return redirect()->route('accounts');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileExport(Request $request)
    {
        return Excel::download(new AccountsExport, 'account.xlsx');
    }
}
