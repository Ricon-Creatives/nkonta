<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use DB;
use Illuminate\Support\Collection;
use App\Services\SummaryService;


class TrialSummaryController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    $companyId = auth()->user()->currentTeam->id;

    $transactions =  DB::table('transactions')->where('transactions.team_id',$companyId)
    ->join('companyaccount', 'transactions.account_id', '=', 'companyaccount.id')
    ->whereDate('transactions.created_at',Carbon::today())
    ->select('companyaccount.code',DB::raw('SUM(amount) as amount,transactions.type,companyaccount.name,companyaccount.group_by_code'))
    ->groupBy('companyaccount.group_by_code','companyaccount.code','transactions.type','companyaccount.name')
    ->get();

    //Find duplicate accounts
    $exists_array = $this->summaryService->FindDuplicate($transactions);
    //Find Net of accounts with same codes
   $resultArray = $this->summaryService->diffArray($exists_array,$exists_array);
    //Remove duplicates
   $uniqueArray = $this->summaryService->unique_multidimensional_array($transactions, 'code');
   //Merge Same account codes after finding the difference
   $newTransactions =  array_merge($uniqueArray,$resultArray);
    //find transaction
    return view('dashboard.reports.summary', compact('newTransactions'));
    }


}
