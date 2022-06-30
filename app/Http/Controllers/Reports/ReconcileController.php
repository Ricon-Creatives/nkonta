<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Account;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TransactionImport;
use Illuminate\Support\Carbon;


class ReconcileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matched =array();
        $unmatched =array();

        return view('dashboard.reconcilation.index',compact('matched','unmatched'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $month = Carbon::parse($request->to_month)->format('m');
        //dd($request->to_month);

        $import = new TransactionImport;
        $import->setMonth($month);

         Excel::import($import,  $request->file('file'));
         $matched = $import->getMatched();
         $unmatched = $import->getUnMatched();

        return view('dashboard.reconcilation.index',compact('matched','unmatched'));
    }

}
