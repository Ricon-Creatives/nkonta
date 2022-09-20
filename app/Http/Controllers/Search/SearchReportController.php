<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use App\Models\Total;
use App\Models\Title;
use App\Models\CompanyAccount;
use App\Services\SummaryService;
use DB;


class SearchReportController extends Controller
{
     /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(SummaryService $summaryService)
    {
        $this->summaryService = $summaryService;
    }

    public function revenueFilter(Request $request)
    {
        $user = auth()->user();
        $data = $request->all();

        $from = Carbon::parse($request->from_date);
        $to = Carbon::parse($request->to_date);

        $transactions = Transaction::join('companyaccount', 'transactions.account_id', '=', 'companyaccount.id')
        ->where('companyaccount.company_id',$user->current_team_id)
        ->where('companyaccount.type',$request->type)
        ->whereBetween('transactions.created_at',[$from,$to])
        ->paginate(10);

        $transactions->appends($data);

        return view('dashboard.reports.revenue',compact('transactions','data'));
    }

    public function expenseFilter(Request $request)
    {
        $user = auth()->user();
        $data = $request->all();

        $from = Carbon::parse($request->from_date);
        $to = Carbon::parse($request->to_date);

        $transactions = Transaction::join('companyaccount', 'transactions.account_id', '=', 'companyaccount.id')
        ->where('companyaccount.company_id',$user->current_team_id)
        ->where('companyaccount.type','Expense')
        ->whereBetween('transactions.created_at',[$from,$to])
        ->paginate(10);

       // dd($transactions);
        $transactions->appends($data);

        return view('dashboard.reports.expense',compact('transactions','data'));
    }

    public function taxFilter(Request $request)
    {
        $user = auth()->user();
        $data = $request->all();

        $from = Carbon::parse($request->from_date);
        $to = Carbon::parse($request->to_date);

        $transactions = Transaction::join('companyaccount', 'transactions.account_id', '=', 'companyaccount.id')
        ->where('companyaccount.company_id',$user->current_team_id)
        ->where('companyaccount.type',$request->type)
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
        ->join('companyaccount', 'transactions.account_id', '=', 'companyaccount.id')
        ->where('companyaccount.company_id',auth()->user()->current_team_id)
        ->whereBetween('transactions.created_at',[$from,$to])
        ->select('companyaccount.code',DB::raw('SUM(amount) as amount,transactions.type,companyaccount.name,companyaccount.group_by_code'))
        ->groupBy('companyaccount.group_by_code','companyaccount.code','transactions.type','companyaccount.name')
        ->get()->toArray();

        //Find duplicate accounts
        $exists_array = $this->summaryService->FindDuplicate($transactions);
         //Find Net of accounts with same codes
        $resultArray = $this->summaryService->diffArray($exists_array,$exists_array);
         //Remove duplicates
        $uniqueArray = $this->summaryService->unique_multidimensional_array($transactions, 'code');
        //Merge Same account codes after finding the difference
        $newTransactions =  array_merge($uniqueArray,$resultArray);


        return view('dashboard.reports.summary',compact('newTransactions','data'));
    }

    public function balSheetFilter(Request $request)
    {
        $companyId = auth()->user()->currentTeam->id;
        $data = $request->all();

        $from = Carbon::parse($request->from_date);
        $to = Carbon::parse($request->to_date);

        //generate the accounts for balance sheet
        $accounts = DB::table('totals')->where('totals.team_id',$companyId)
        ->join('companyaccount', 'totals.account_id', '=', 'companyaccount.id')
        ->where('companyaccount.company_id',auth()->user()->current_team_id)
        ->whereBetween('totals.created_at', [$from,$to])
        ->where('companyaccount.type','!=','Revenue')->where('companyaccount.type','!=','Expense')
        ->select('companyaccount.code',DB::raw('SUM(amount) as amount,companyaccount.type,companyaccount.name'))
        ->groupBy('companyaccount.code','companyaccount.type','companyaccount.name')
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
        $books = Total::join('companyaccount', 'totals.account_id', '=', 'companyaccount.id')
        ->where('companyaccount.company_id',auth()->user()->current_team_id)
        ->whereBetween('totals.created_at', [$from,$to])
        ->orWhere('companyaccount.type','Expense')
        ->where('companyaccount.type','Revenue')
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
        $transactions = Transaction::with(['companyaccount'])
        ->where(function($query) use ($search){
            $query->where('company_name', 'Like',"%$search%")->orWhere('type','Like',"%$search%")
            ->orWhere('amount','Like',"%$search%")->orWhere('reference_no','Like',"%$search%");
            })->paginate(10);

       $accounts = CompanyAccount::where('company_id',auth()->user()->current_team_id)->get();

        $transactions->appends($data);

        return view('dashboard.reports.transactions',compact('transactions','accounts'));
    }

    public function sales(Request $request)
    {
        $data = $request->all();
        $search =\Request::get('search');

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
