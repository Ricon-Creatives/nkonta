<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Total;
use Illuminate\Support\Carbon;
use DB;


class ProfitLossController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user()->id;

        $books = Total::join('companyaccount', 'totals.account_id', '=', 'companyaccount.id')
        ->where('companyaccount.company_id',auth()->user()->current_team_id)
        ->whereDate('totals.created_at', Carbon::today())
        ->orWhere('companyaccount.type','Expense')
        ->where('companyaccount.type','Revenue')
        ->orderBy('totals.created_at')
        ->get();

        /* $totals = DB::table('totals')->where('user_id',$user)
        ->join('accounts', 'totals.account_id', '=', 'accounts.id')
        ->whereDate('totals.created_at',Carbon::today())
        ->whereBetween('accounts.code',[4000,5999])
        ->select('accounts.type',DB::raw('SUM(amount) as total'))
        ->groupBy('accounts.type')
        ->havingRaw('SUM(amount) > ?', [1])
        ->get();
*/

     // dd($books);


        return view('dashboard.reports.profitLoss',compact('books'));
    }


}
