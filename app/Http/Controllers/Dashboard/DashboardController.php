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
         $user = auth()->user();
         $bank1 = Transaction::with('companyaccount')
         ->join('companyaccount', 'transactions.account_id', '=', 'companyaccount.id')
         ->where('companyaccount.company_id',$user->current_team_id)
         ->where('companyaccount.name','Bank Acount 1')
         ->sum('transactions.amount');

         $bank2 = Transaction::with('account')
         ->join('companyaccount', 'transactions.account_id', '=', 'companyaccount.id')
         ->where('companyaccount.company_id',$user->current_team_id)
         ->where('companyaccount.name','Bank Acount 2')
         ->sum('transactions.amount');

         $pettyCash = Transaction::with('account')
         ->join('companyaccount', 'transactions.account_id', '=', 'companyaccount.id')
         ->where('companyaccount.company_id',$user->current_team_id)
         ->where('companyaccount.name','Petty Cash')
         ->sum('transactions.amount');

        //dd($query);

        return view('dashboard.home', compact('bank1','bank2','pettyCash'));
    }

    public function income()
    {
        $user = auth()->user();

        $query = Transaction::with('companyaccount')
        ->join('companyaccount', 'transactions.account_id', '=', 'companyaccount.id')
        ->where('companyaccount.company_id',$user->current_team_id)
        ->where('companyaccount.type','Revenue')->orWhere('companyaccount.type','Expense')
        ->select("transactions.type", DB::raw('SUM(amount) as total,companyaccount.name,transactions.type'))
        ->groupBy(["transactions.type","companyaccount.name"])
       /// ->orderBy('companyaccount.name','asc')
        ->get();

        $receivables = Transaction::with('companyaccount')
        ->join('companyaccount', 'transactions.account_id', '=', 'companyaccount.id')
        ->where('companyaccount.company_id',$user->current_team_id)
        ->where('companyaccount.name','Accounts Receivable')
        ->sum('transactions.amount');

       $revenue = Transaction::with('companyaccount')
       ->join('companyaccount', 'transactions.account_id', '=', 'companyaccount.id')
       ->where('companyaccount.company_id',$user->current_team_id)
       ->where('companyaccount.name','Revenue')
       ->sum('transactions.amount');

       return response()->json([
        'result' => $query,
        'data' => ['revenue' => $revenue, 'recievables' => $receivables]
      ]);

    }

    public function cash()
    {
        $user = auth()->user();

          $bank1 = Transaction::with('companyaccount')
          ->join('companyaccount', 'transactions.account_id', '=', 'companyaccount.id')
          ->where('companyaccount.company_id',$user->current_team_id)
          ->where('companyaccount.name','Bank Acount 1')
          ->sum('transactions.amount');

          $bank2 = Transaction::with('companyaccount')
          ->join('companyaccount', 'transactions.account_id', '=', 'companyaccount.id')
          ->where('companyaccount.company_id',$user->current_team_id)
          ->where('companyaccount.name','Bank Acount 2')
          ->sum('transactions.amount');

          $pettyCash = Transaction::with('companyaccount')
          ->join('companyaccount', 'transactions.account_id', '=', 'companyaccount.id')
          ->where('companyaccount.company_id',$user->current_team_id)
          ->where('companyaccount.name','Petty Cash')
          ->sum('transactions.amount');

       // dd($totalRevenue);
          return response()->json([
            'bank1' => $bank1,
            'bank2' => $bank2,
            'cash' => $pettyCash
          ]);
    }


}
