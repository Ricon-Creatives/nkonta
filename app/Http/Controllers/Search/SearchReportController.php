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

        $transactions = Transaction::join('accounts', 'transactions.account_id', '=', 'accounts.id')
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

        $transactions = Transaction::join('accounts', 'transactions.account_id', '=', 'accounts.id')
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

        $transactions = Transaction::join('accounts', 'transactions.account_id', '=', 'accounts.id')
        ->where('accounts.type',$request->type)
        ->whereBetween('transactions.created_at',[$from,$to])
        ->paginate(10);

        $transactions->appends($data);

        return view('dashboard.reports.tax',compact('transactions','data'));
    }

    public function trialSummaryFilter(Request $request)
    {
        $companyId = auth()->user()->currentTeam->id;
        $data = $request->all();

        $from = Carbon::parse($request->from_date);
        $to = Carbon::parse($request->to_date);

        $transactions =  DB::table('transactions')->where('transactions.team_id',$companyId)
        ->join('accounts', 'transactions.account_id', '=', 'accounts.id')
        ->whereBetween('transactions.created_at',[$from,$to])
        ->select('accounts.code',DB::raw('SUM(amount) as amount,transactions.type,accounts.name,accounts.group_by_code'))
        ->groupBy('accounts.group_by_code','accounts.code','transactions.type','accounts.name')
        ->get();

        //dd($transactions);
        //$transactions->appends($data);

        return view('dashboard.reports.summary',compact('transactions','data'));
    }

    public function balSheetFilter(Request $request)
    {
        $companyId = auth()->user()->currentTeam->id;
        $data = $request->all();

        $from = Carbon::parse($request->from_date);
        $to = Carbon::parse($request->to_date);

        //generate the accounts for balance sheet
        $accounts = DB::table('totals')->where('totals.team_id',$companyId)
        ->join('accounts', 'totals.account_id', '=', 'accounts.id')
        ->whereBetween('totals.created_at', [$from,$to])
        ->where('accounts.type','!=','Revenue')->where('accounts.type','!=','Expense')
        ->select('accounts.code',DB::raw('SUM(amount) as amount,accounts.type,accounts.name'))
        ->groupBy('accounts.code','accounts.type','accounts.name')
        ->get();

        //dd($data);
       // $accounts->appends($data);

        return view('dashboard.reports.balSheet', compact('accounts','data'))->with('account');
    }

    public function profitLossFilter(Request $request)
    {
        $data = $request->all();

        $from = Carbon::parse($request->from_date);
        $to = Carbon::parse($request->to_date);

        //generate the accounts for balance sheet
        $books = Total::join('accounts', 'totals.account_id', '=', 'accounts.id')
        ->whereBetween('totals.created_at', [$from,$to])
        ->orWhere('accounts.type','Expense')
        ->where('accounts.type','Revenue')
        ->orderBy('totals.created_at')
        ->get();

        //$transactions->appends($data);

        return view('dashboard.reports.profitLoss',compact('books'));
    }

    public function transactionsFilter(Request $request)
    {
        $data = $request->all();
        $search =\Request::get('search');

        //generate the accounts for balance sheet
        $transactions = Transaction::with(['account'])
        ->where(function($query) use ($search){
            $query->where('company_name', 'Like',"%$search%")->orWhere('type','Like',"%$search%")
            ->orWhere('amount','Like',"%$search%")->orWhere('reference_no','Like',"%$search%");
            })->paginate(10);

            $accounts = Account::get();

        $transactions->appends($data);

        return view('dashboard.reports.transactions',compact('transactions','accounts'));
    }

    public function sales(Request $request)
    {
        $data = $request->all();
        $search =\Request::get('search');

        //generate the accounts for balance sheet
        $sales = Title::where('type','income')
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
        $data = $request->all();
        $search =\Request::get('search');

        //generate the accounts for balance sheet
        $purchases = Title::where('type','expense')
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
