<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Company;
use App\Models\Industry;
use DB;
class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = DB::table('transactions')->join('accounts', 'transactions.account_id', '=', 'accounts.id')
        //->join('companies', 'transactions.team_id', '=', 'companies.id')
        ->select('transactions.id','transactions.type','transactions.reference_no','transactions.description_to_debit','transactions.description_to_credit',
        'transactions.date','transactions.created_at','transactions.amount','accounts.code','accounts.name',)
        ->latest('transactions.created_at')->paginate(10);

       // dd($transactions);
        return view('admin.transaction.index', compact('transactions'));
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
        $transaction = Transaction::find($id);
        //Find Company
        $company = Company::find($transaction->team_id);
        //Find Industry
        $industries = Industry::find($company->industry_id);
        //Get Accounts from company's industry
        $accounts = $industries->accounts;

        return view('admin.transaction.edit', compact('transaction','accounts'));
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
        //dd($request);

        $user = auth()->user();

        $transaction = Transaction::find($id);
        $transaction->amount = $request->amount;
        $transaction->account_id  = $request->account;
        $transaction->category_id = $request->category;
        $transaction->description_to_debit = $request->description_to_debit;
        $transaction->description_to_credit = $request->description_to_credit;
        $transaction->company_name = $request->company_name;
        $transaction->expected_payment_date = $request->expected_payment_date;
        $transaction->contact_address = $request->contact_address;
        $transaction->update();

        return redirect()->route('transaction.index')->withMessage('Updated');
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
