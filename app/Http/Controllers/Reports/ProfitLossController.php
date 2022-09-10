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

        $books = Total::join('accounts', 'totals.account_id', '=', 'accounts.id')
        ->whereDate('totals.created_at', Carbon::today())
        ->orWhere('accounts.type','Expense')
        ->where('accounts.type','Revenue')
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
