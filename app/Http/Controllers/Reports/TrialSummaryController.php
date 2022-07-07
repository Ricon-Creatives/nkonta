<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use DB;
use Illuminate\Support\Collection;

class TrialSummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    $user = auth()->user()->id;

    $credits = Transaction::with('account')->where('user_id',$user)->where('type','credit')
    ->whereDate('created_at',Carbon::today())
    ->orderBy('reference_no')
    ->get();

    $debits = Transaction::with('account')->where('user_id',$user)->where('type','debit')
    ->whereDate('created_at',Carbon::today())
    ->orderBy('reference_no')
    ->get();

  /*  $transactions = [];

    foreach($debits as $debit) {
        foreach ($credits as $credit) {
            if ($debit['reference_no'] == $credit['reference_no']) {

             array_push($transactions,[
                    'ref_no_debit' => $debit['reference_no'],
                    'ref_no_credit' => $credit['reference_no'],
                    'user_id' => $debit['user_id'],
                    'date' => $debit['date'],
                    'descritption' => $debit['description'],
                    'amount' => $debit['amount'],
                    'debit_account' => $debit['account_id'],
                    'credit_account' => $credit['account_id'],
                    'created_at' =>  $debit['created_at'],
                ]);
            }
        }
    }*/


   // dd(collect($transactions));
 //   dd($credits);

    return view('dashboard.reports.summary', compact('debits','credits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($transactions)
    {


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
