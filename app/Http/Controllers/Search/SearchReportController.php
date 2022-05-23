<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Carbon;


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

        return view('dashboard.reports.revenue',compact('transactions'));
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

        //dd($transactions);
        $transactions->appends($data);

        return view('dashboard.reports.expense',compact('transactions'));
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

        return view('dashboard.reports.tax',compact('transactions'));
    }
}
