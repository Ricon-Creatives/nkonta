<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Total;
use App\Models\Transaction;
use DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class TotalController extends Controller
{

    /**
     * Display balance sheet reports.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companyId = auth()->user()->currentTeam->id;

        //generate the accounts for balance sheet
        $accounts =  DB::table('totals')->where('totals.team_id',$companyId)
        ->join('companyaccount', 'totals.account_id', '=', 'companyaccount.id')
        ->where('companyaccount.company_id',auth()->user()->current_team_id)
        ->whereDate('totals.created_at', Carbon::today())
        ->where('companyaccount.type','!=','Revenue')->where('companyaccount.type','!=','Expense')
        ->select('companyaccount.code',DB::raw('SUM(amount) as amount,companyaccount.type,companyaccount.name'))
        ->groupBy('companyaccount.code','companyaccount.type','companyaccount.name')
        ->get();

       /* //
        $totalAssets = DB::table('totals')->where('user_id',$user)
        ->join('accounts', 'totals.account_id', '=', 'accounts.id')
        ->whereBetween('accounts.code',[1000,1920])
        ->whereDate('totals.created_at',Carbon::today())
        ->select('accounts.type',DB::raw('SUM(amount) as total'))
        ->groupBy('accounts.type')groupBy
        ->get();

        //
        $totalLiab = DB::table('totals')->where('user_id',$user)
        ->join('accounts', 'totals.account_id', '=', 'accounts.id')
        ->whereDate('totals.created_at',Carbon::today())
        ->whereBetween('accounts.code',[2100,2600])
        ->select('accounts.type',DB::raw('SUM(amount) as total'))
        ->groupBy('accounts.type')
        ->get();
        //
        $totalEquity = DB::table('totals')->where('user_id',$user)
        ->join('accounts', 'totals.account_id', '=', 'accounts.id')
        ->whereDate('totals.created_at',Carbon::today())
        ->whereBetween('accounts.code',[2700,3200])
        ->select('accounts.type',DB::raw('SUM(amount) as total'))
        ->('accounts.type')
        ->get();*/

        //$totals =  $totalAssets->concat($totalLiab)->concat($totalEquity);

       //dd($accounts);


    return view('dashboard.reports.balSheet', compact('accounts'))->with('account');
    }

     /*

    public function store($user)
    {

         //Sum total credits
        $credit = Transaction::with('account')->where('type','credit')
        ->select("account_id", DB::raw('SUM(amount) as total'))
        ->groupBy("account_id")
        ->havingRaw('SUM(amount) > ?', [1])
        ->get();

        //Sum total debits
        $debit = Transaction::with('account')->where('type','debit')
        ->select("account_id", DB::raw('SUM(amount) as total'))
        ->groupBy("account_id")
        ->havingRaw('SUM(amount) > ?', [1])
        ->get();

        foreach($debit as &$acc) {

                $acc['type'] = 'debit';
      }


      $transactions =  $debit->concat($credit);

        foreach ($transactions as $input) {

            //acountId-amount-date
            $slug = Str::slug($input->account_id.$input->total.Carbon::today()->format('d-m-Y'));
            $accounts = Total::select('slug')->where('slug', $slug)->doesntExist();

              if ($accounts) {
                  $data = auth()->user()->totals()->create([
                      'account_id'=> $input->account_id,
                      'type'=> ($input->type == 'debit') ? "debit" : "credit",
                      'amount' => $input->total,
                      'slug'=> $slug,
                  ]);

                  $data->save();
              }
        }
    }
  */

}
