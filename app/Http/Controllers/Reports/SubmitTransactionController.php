<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payroll;
use App\Models\Account;
use App\Models\Transaction;
use App\Services\ReportService;
use Illuminate\Support\Carbon;

class SubmitTransactionController extends Controller
{
     /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function submit()
    {
        $user = auth()->user();
        $month = Carbon::today()->format('m');
        $type = 'expense';
        $slug = 'payroll-'.$month;
        //Get total salaries and tax for the month
        $salaryAmount = Payroll::whereBelongsTo($user)->whereMonth('created_at',$month)->sum('salary');
        $taxAmount = Payroll::whereBelongsTo($user)->whereMonth('created_at',$month)->sum('tax_deductable');
        //Get account ids for salary and tax (Salary - Bank Account)(Tax - Bank Account)
        $slarayId = Account::where('code','6070')->get();
        $bankId = Account::select('id','code','name')->where('code','1010')->get();
        $taxId = Account::select('id','code','name')->where('code','7200')->get();

        //Create a request
        $salariesRequest = new Request([
            'acc_dr'=> $bankId[0]->id,
            'acc_cr'=> $slarayId[0]->id,
            'description_to_debit'=> '',
            'slug' => $slug
        ]);

        $taxRequest = new Request([
            'acc_dr'=> $bankId[0]->id,
            'acc_cr'=> $taxId[0]->id,
            'description_to_debit'=> '',
            'slug' => $slug
        ]);

        //Check if slug exist
        $isTrue = Transaction::whereBelongsTo($user)->where('slug',$slug)->count();
        if ($isTrue < 4) {
        //Send to controller
        $this->reportService->storeTransaction($salariesRequest,$type,$salaryAmount);
        $this->reportService->storeTransaction($taxRequest,$type, $taxAmount);
    }

    //Response Message
        return redirect()->route('payroll.index');
    }
}
