<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use App\Models\Total;
use App\Models\Title;
use App\Models\Account;
use DB;


class SearchReportController extends Controller
{
    public function revenueFilter(Request $request)
    {
        $user = auth()->user()->id;
        $data = $request->all();

        $from = Carbon::parse($request->from_date);
        $to = Carbon::parse($request->to_date);

        $transactions = Transaction::where('user_id',$user)
        ->join('accounts', 'transactions.account_id', '=', 'accounts.id')
        ->where('accounts.type',$request->type)
        ->whereBetween('transactions.created_at',[$from,$to])
        ->paginate(10);

        $transactions->appends($data);

        return view('dashboard.reports.revenue',compact('transactions','data'));
    }

    public function expenseFilter(Request $request)
    {
        $user = auth()->user()->id;
        $data = $request->all();

        $from = Carbon::parse($request->from_date);
        $to = Carbon::parse($request->to_date);

        $transactions = Transaction::where('user_id',$user)
        ->join('accounts', 'transactions.account_id', '=', 'accounts.id')
        ->where('accounts.type','Expense')
        ->whereBetween('transactions.created_at',[$from,$to])
        ->paginate(10);

       // dd($transactions);
        $transactions->appends($data);

        return view('dashboard.reports.expense',compact('transactions','data'));
    }

    public function taxFilter(Request $request)
    {
        $user = auth()->user()->id;
        $data = $request->all();

        $from = Carbon::parse($request->from_date);
        $to = Carbon::parse($request->to_date);

        $transactions = Transaction::where('user_id',$user)
        ->join('accounts', 'transactions.account_id', '=', 'accounts.id')
        ->where('accounts.type',$request->type)
        ->whereBetween('transactions.created_at',[$from,$to])
        ->paginate(10);

        $transactions->appends($data);

        return view('dashboard.reports.tax',compact('transactions','data'));
    }

    public function trialSummaryFilter(Request $request)
    {
        $user = auth()->user()->id;
        $data = $request->all();

        $from = Carbon::parse($request->from_date);
        $to = Carbon::parse($request->to_date);

        $credits = Transaction::with('account')->where('user_id',$user)->where('type','credit')
        ->whereBetween('created_at',[$from,$to])
        ->orderBy('reference_no')
        ->get();

        $debits = Transaction::with('account')->where('user_id',$user)->where('type','debit')
        ->whereBetween('created_at',[$from,$to])
        ->orderBy('reference_no')
        ->get();

        //$transactions->appends($data);

        return view('dashboard.summary',compact('debits','credits','data'));
    }

    public function balSheetFilter(Request $request)
    {
        $user = auth()->user()->id;
        $data = $request->all();

        $from = Carbon::parse($request->from_date);
        $to = Carbon::parse($request->to_date);

        //generate the accounts for balance sheet
        $accounts = DB::table('totals')->where('user_id',$user)
        ->join('accounts', 'totals.account_id', '=', 'accounts.id')
        ->whereBetween('totals.created_at', [$from,$to])
        ->where('accounts.type','!=','Revenue')->where('accounts.type','!=','Expense')
        //->select(['accounts.code',DB::raw('SUM(amount) as amount')])
        ->orderBy('accounts.code')
        ->get();

        //dd($data);
       // $accounts->appends($data);

        return view('dashboard.balSheet', compact('accounts','data'))->with('account');
    }

    public function profitLossFilter(Request $request)
    {
        $user = auth()->user()->id;
        $data = $request->all();

        $from = Carbon::parse($request->from_date);
        $to = Carbon::parse($request->to_date);

        //generate the accounts for balance sheet
        $books = Total::where('user_id',$user)
        ->join('accounts', 'totals.account_id', '=', 'accounts.id')
        ->whereBetween('totals.created_at', [$from,$to])
        ->orWhere('accounts.type','Expense')
        ->where('accounts.type','Revenue')
        ->orderBy('totals.created_at')
        ->get();

        //$transactions->appends($data);

        return view('dashboard.profitLoss',compact('books'));
    }

    public function transactionsFilter(Request $request)
    {
        $user = auth()->user();
        $data = $request->all();
        $search =\Request::get('search');

        //generate the accounts for balance sheet
        $transactions = Transaction::with(['account'])->whereBelongsTo($user)
        ->where(function($query) use ($search){
            $query->where('company_name', 'Like',"%$search%")->orWhere('type','Like',"%$search%")
            ->orWhere('amount','Like',"%$search%")->orWhere('reference_no','Like',"%$search%");
            })->paginate(10);

            $accounts = Account::get();

        $transactions->appends($data);

        return view('dashboard.transactions',compact('transactions','accounts'));
    }

    public function sales(Request $request)
    {
        $user = auth()->user();
        $data = $request->all();
        $search =\Request::get('search');

        //generate the accounts for balance sheet
        $sales = Title::whereBelongsTo($user)->where('type','Selling')
        ->where(function($query) use ($search){
            $query->where('name', 'Like',"%$search%")->orWhere('vat','Like',"%$search%")
            ->orWhere('address','Like',"%$search%")->orWhere('contact_no','Like',"%$search%")
            ->orWhere('contact_person','Like',"%$search%")->orWhere('due_date','Like',"%$search%")
           ;
            })->paginate(10);


        $sales->appends($data);

        return view('dashboard.sales.index',compact('sales'));
    }

    public function purchases(Request $request)
    {
        $user = auth()->user();
        $data = $request->all();
        $search =\Request::get('search');

        //generate the accounts for balance sheet
        $purchases = Title::whereBelongsTo($user)->where('type','Buying')
        ->where(function($query) use ($search){
            $query->where('name', 'Like',"%$search%")->orWhere('vat','Like',"%$search%")
            ->orWhere('address','Like',"%$search%")->orWhere('contact_no','Like',"%$search%")
            ->orWhere('contact_person','Like',"%$search%")->orWhere('due_date','Like',"%$search%")
            ;
            })->paginate(10);


        $purchases->appends($data);

        return view('dashboard.purchases.index',compact('purchases'));
    }

}
