<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use DB;


class DashboardController extends Controller
{

    public function index()
    {
         $user = auth()->user()->id;
         $bank1 = Transaction::with('account')
         ->join('accounts', 'transactions.account_id', '=', 'accounts.id')
         ->where('accounts.name','Bank Acount 1')
         ->sum('transactions.amount');

         $bank2 = Transaction::with('account')
         ->join('accounts', 'transactions.account_id', '=', 'accounts.id')
         ->where('accounts.name','Bank Acount 2')
         ->sum('transactions.amount');

         $pettyCash = Transaction::with('account')
         ->join('accounts', 'transactions.account_id', '=', 'accounts.id')
         ->where('accounts.name','Petty Cash')
         ->sum('transactions.amount');

        //dd($query);

        return view('dashboard.home', compact('bank1','bank2','pettyCash'));
    }

    public function income()
    {
        $user = auth()->user()->id;

        $query = Transaction::with('account')
        ->join('accounts', 'transactions.account_id', '=', 'accounts.id')
        ->where('accounts.type','Revenue')->orWhere('accounts.type','Expense')
        ->select("transactions.type", DB::raw('SUM(amount) as total,accounts.name,transactions.type'))
        ->groupBy(["transactions.type","accounts.name"])
       /// ->orderBy('accounts.name','asc')
        ->get();

        $receivables = Transaction::with('account')
        ->join('accounts', 'transactions.account_id', '=', 'accounts.id')
        ->where('accounts.name','Accounts Receivable')
        ->sum('transactions.amount');

       $revenue = Transaction::with('account')
       ->join('accounts', 'transactions.account_id', '=', 'accounts.id')
       ->where('accounts.name','Revenue')
       ->sum('transactions.amount');

       return response()->json([
        'result' => $query,
        'data' => ['revenue' => $revenue, 'recievables' => $receivables]
      ]);

    }

    public function cash()
    {
        $user = auth()->user()->id;

          $bank1 = Transaction::with('account')
          ->join('accounts', 'transactions.account_id', '=', 'accounts.id')
          ->where('accounts.name','Bank Acount 1')
          ->sum('transactions.amount');

          $bank2 = Transaction::with('account')
          ->join('accounts', 'transactions.account_id', '=', 'accounts.id')
          ->where('accounts.name','Bank Acount 2')
          ->sum('transactions.amount');

          $pettyCash = Transaction::with('account')
          ->join('accounts', 'transactions.account_id', '=', 'accounts.id')
          ->where('accounts.name','Petty Cash')
          ->sum('transactions.amount');

       // dd($totalRevenue);
          return response()->json([
            'bank1' => $bank1,
            'bank2' => $bank2,
            'cash' => $pettyCash
          ]);
    }


}
