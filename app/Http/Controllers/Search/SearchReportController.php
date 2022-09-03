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
        ->get()->toArray();

       $exists_array = [];
        foreach ($transactions as $current_key => $current_array) {
        //echo "current key: $current_key<br>";
        foreach ($transactions as $search_key => $search_array) {
            if ($search_array->code == $current_array->code) {
                if ($search_key != $current_key) {
               array_push($exists_array,$search_array);
                }
            }
        }
        }

        function diffArray($arr1, $arr2) {
            $result = [];
            for ($i=0; $i < count($arr1) ; $i++) {
                for ($j=0; $j <  count($arr1); $j++) {
                    # code...
                }
            }
            foreach($arr1 as &$value1) {
                foreach($arr2 as &$value2) {
                    if ($value1->code == $value2->code && $value1->type != $value2->type) {
                        if ($value1->type == 'debit') {
                            if (@$value1->checked != 1  || $value2->checked != 1) {
                                $minus = $value1->amount - $value2->amount;
                                $value1->type =   ($minus>0) ? 'debit' : 'credit';
                                $value1->amount = abs($minus);
                                $value1->checked = 1;
                                $value2->checked = 1;
                                \array_push($result,$value1);
                            }

                        } else{
                            if (@$value1->checked != 1 || $value2->checked != 1) {
                            $minus = $value2->amount - $value1->amount;
                            $value1->type =  ($minus>0) ? 'debit' : 'credit';
                            $value1->amount = abs($minus);
                            $value1->checked = 1;
                            $value2->checked = 1;
                            \array_push($result,$value1);
                            }
                        }
                    }
                }
            }
            return $result;
        }

        function trackMerge ($toMerge,$merger) {
            $result = [];
            foreach ($toMerge as $currentValue) {
                foreach ($merger as $compareValue) {
                    if ($compareValue->code == $currentValue->code) {
                       array_push($result,$compareValue);
                    }else{
                        array_push($result,$currentValue);
                    }
                }
                }
                return $result;
        }

        function unique_multidimensional_array($array, $key) {
            $temp_array = array();
            $i = 0;
            $key_array = array();

            foreach($array as $val) {
                if (!in_array($val->$key, $key_array)) {
                    $key_array[$i] = $val->$key;
                    $temp_array[$i] = $val;
                }else if (in_array($val->$key, $key_array)){
                    unset($temp_array[$i-1]);
                }
                $i++;
            }
            return $temp_array;
        }

        $resultArray = diffArray($exists_array,$exists_array);
        $uniqueArray = unique_multidimensional_array($transactions, 'code');
       $newTransactions =  array_merge($uniqueArray,$resultArray);
       //dd($newTransactions);
        //$newTransactions = trackMerge($uniqueArray,$resultArray);
         // dd($transactions);
        //

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
