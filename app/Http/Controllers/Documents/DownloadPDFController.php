<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use App\Models\Transaction;
use App\Models\Total;
use DB;
use PDF;

class DownloadPDFController extends Controller
{
      /**
     * Export content to PDF with View
     *
     * @return void
     */
    public function downloadBalSheetPdf()
    {
        $user = auth()->user()->id;

        //generate the accounts for balance sheet
        $accounts =  DB::table('totals')->where('user_id',$user)
        ->join('accounts', 'totals.account_id', '=', 'accounts.id')
        ->whereDate('totals.created_at', Carbon::today())
        ->where('accounts.type','!=','income')->where('accounts.type','!=','expense')
        ->orderBy('accounts.code')
        ->get();

        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        // share data to view
       // view()->share('dashboard.balSheet',$accounts);

       $data = ['accounts' => $accounts];
        $pdf = PDF::loadView('dashboard.balSheet', $data);

        return $pdf->download('balanceSheet.pdf');
    }

     /**
     * Export content to PDF with View
     *
     * @return void
     */
    public function downloadPLPdf()
    {

        //generate the accounts for balance sheet
        $user = auth()->user()->id;

        $books = Total::where('user_id',$user)
        ->join('accounts', 'totals.account_id', '=', 'accounts.id')
        ->whereDate('totals.created_at',Carbon::today())
        ->whereBetween('accounts.code',[4000,5999])
        ->orderBy('accounts.code')
        ->get();

        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        // share data to view
       // view()->share('dashboard.balSheet',$accounts);

       $data = ['books' => $books];
        $pdf = PDF::loadView('dashboard.profitLoss', $data);

        return $pdf->download('profitLoss.pdf');
    }

     /**
     * Export content to PDF with View
     *
     * @return void
     */
    public function downloadTrialBalPdf()
    {

        //generate the accounts for balance sheet
        $user = auth()->user()->id;

        $credits = Transaction::with('account')->where('user_id',$user)->where('type','credit')
        ->whereDate('created_at',Carbon::today())
        ->orderBy('reference_no')
        ->get();

        $debits = Transaction::with('account')->where('user_id',$user)->where('type','debit')
        ->whereDate('created_at',Carbon::today())
        ->orderBy('reference_no')
        ->get();


        //PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        // share data to view
        $data = ['debits' => $debits, 'credits' => $credits];

        $pdf = PDF::loadView('dashboard.summary', $data);

        return $pdf->download('trialBalance.pdf');
    }
}
