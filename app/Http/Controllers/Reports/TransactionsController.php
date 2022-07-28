<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Total;
use App\Models\Account;
use App\Models\Industry;
use App\Services\ReportService;
use Illuminate\Support\Carbon;
use App\Http\Requests\StoreTransactionRequest;
use Illuminate\Support\Facades\DB;

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
        $transactions = Transaction::with(['account'])
       // ->whereDate('created_at',Carbon::today())
        ->latest()->paginate(10);
        $industries = Industry::find(auth()->user()->currentTeam->industry_id);
        $accounts = $industries->accounts;

        return view('dashboard.transactions.index', compact('transactions','accounts'));
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
    public function store(StoreTransactionRequest $request)
    {
       DB::transaction(function () use ($request): void {

        $reference_no =  mt_rand(10000, 99999);
        //dd($reference_no);

       $data = Transaction::create([
            'date'=> $request->date,
            'team_id' => auth()->user()->currentTeam->id,
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

         $transactions = [$data,$copy];
         //
         $this->reportService->storeTotals($transactions);
     });

        return redirect()->route('transaction.index')->withMessage('Transaction added.');
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
    public function edit(Transaction $transaction)
    {
        $industries = Industry::find(auth()->user()->currentTeam->industry_id);
        $accounts = $industries->accounts;

        return view('dashboard.transactions.edit',compact('transaction','accounts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transactions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
       DB::transaction(function () use ($request,$transaction): void {
       $companyId = auth()->user()->currentTeam->id;
        //Upate Transaction
       $transaction->update($request->all());
        //Find Total an Update
        Total::where('transaction_id',$transaction->id)->where('team_id',$companyId)
        ->update(['amount' => $transaction->amount,'account_id' => $transaction->account_id ]);
        });

        return redirect()->route('transaction.index')->withMessage('Transaction updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transactions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        DB::transaction(function () use ($transaction): void {
        //delete transaction
        Transaction::where('id',$transaction->id)->first()->delete();
        //delete total
        $record  = Total::where('transaction_id',$transaction->id)->first();
        if($record){
            $record->delete();
        }
    });

        return redirect()->route('transaction.index')->withMessage('Transaction deleted successfully.');
    }
}
