<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use DB;


class DashboardController extends Controller
{

    public function income()
    {
        $user = auth()->user()->id;

          $totalRevenue = Transaction::with('account')
          ->join('accounts', 'transactions.account_id', '=', 'accounts.id')
          ->where('accounts.type','Revenue')
          ->sum('transactions.amount');

          $totalExpense = Transaction::with('account')
          ->join('accounts', 'transactions.account_id', '=', 'accounts.id')
          ->where('accounts.type','Expense')
          ->sum('transactions.amount');


       // dd($totalRevenue);

        return view('dashboard.home', compact('totalRevenue','totalExpense'));
        # code...
    }
}
