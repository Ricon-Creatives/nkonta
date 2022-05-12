<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use App\Exports\ProfitLossExport;
use Maatwebsite\Excel\Facades\Excel;


class ExportCSVController extends Controller
{
    public function export()
    {
        return Excel::download(new ProfitLossExport, 'Profit-Loss.xlsx');
    }
}
