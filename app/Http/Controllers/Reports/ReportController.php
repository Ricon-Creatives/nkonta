<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Support\Carbon;


class ReportController extends Controller
{

    public function revenue()
    {
        $user = auth()->user()->id;

        $transactions = Transaction::where('user_id',$user)
        ->join('accounts', 'transactions.account_id', '=', 'accounts.id')
        ->where('accounts.type','Revenue')
        ->whereDate('transactions.created_at',Carbon::today())
        ->paginate(10);

       // dd($transactions);

        return view('dashboard.reports.revenue',compact('transactions'));
    }

    public function expenses()
    {
        $user = auth()->user()->id;

        $transactions = Transaction::where('user_id',$user)
        ->join('accounts', 'transactions.account_id', '=', 'accounts.id')
        ->where('accounts.type','Expense')
        ->whereDate('transactions.created_at',Carbon::today())
        ->paginate(10);

        //dd($transactions);

        return view('dashboard.reports.expense',compact('transactions'));
    }

    public function tax()
    {
        $user = auth()->user()->id;

        $transactions = Transaction::where('user_id',$user)
        ->join('accounts', 'transactions.account_id', '=', 'accounts.id')
        ->where('accounts.type','VAT')
        ->whereDate('transactions.created_at',Carbon::today())
        ->paginate(10);

        return view('dashboard.reports.tax',compact('transactions'));
    }
}
