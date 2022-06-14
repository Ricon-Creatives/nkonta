<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Account;
use App\Services\ReportService;
use Illuminate\Support\Carbon;


class TransactionsController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $transactions = Transaction::with(['account'])->whereBelongsTo($user)
       // ->whereDate('created_at',Carbon::today())
        ->oldest()->paginate(10);
        $accounts = Account::get();

        return view('dashboard.transactions', compact('transactions','accounts'));
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
    public function store(Request $request)
    {
        //
       //$randStr  =  Str::random(2);
       //$randNum = mt_rand(1000, 9999);
        $reference_no =  mt_rand(10000, 99999);
        //dd($reference_no);

         $request->validate([
            'date' => '',
            'amount' => ['required',],
            'account' => ['required'],
            'category' => ['required'],
            'description_to_credit' => ['required'],
            'description_to_debit' => ['required'],
            'type' => ['required'],
        ]);

        //dd($request);

       $data = auth()->user()->transactions()->create([
            'date'=> $request->date,
            'amount' => $request->amount,
            'account_id'=> $request->account,
            'category_id'=> $request->category,
            'description_to_debit'=> $request->description_to_debit,
            'type'=> ($request->type == 'income') ? "debit" : "credit",
            'reference_no' => $reference_no,
        ]);

        //if type = income
        $copy = $data->replicate()->fill(
            [
                'date'=> $request->date,
                'amount' => $request->amount,
                'account_id'=> $request->category,
                'category_id'=> $request->category,
                'description_to_credit'=> $request->description_to_credit,
                'type'=> ($request->type == 'income') ? "credit" : "debit" ,
                'reference_no' => $reference_no,
            ]
        );

        $copy->save();
         //($copy);

         $transactions = [$data,$copy];

         $this->reportService->storeTotals($transactions);


        return redirect('/transactions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transactions
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transactions
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transactions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transactions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transactions)
    {
        //
    }
}
