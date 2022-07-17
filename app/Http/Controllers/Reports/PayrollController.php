<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payroll;
use Illuminate\Support\Carbon;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $month = Carbon::today()->format('m');
        $data = Payroll::whereMonth('created_at',$month)->get();
        return view('dashboard.payroll.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.payroll.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //   dd($request);
        //Total Emoluments
        $emoluments = $request->salary + $request->cash_allowance + $request->vehicle_element+
                       $request->accomadation + $request->benefits;
        //Net Taxable Pay
        $taxable_pay = $emoluments - ($request->social_security + $request->deductable_relief);
        //Month
        $month = Carbon::today()->format('m');

        Payroll::create([
            'staff_no' => $request->staff_no,
            'employee_name'=> $request->employee_name,
            'grade'=> $request->grade,
            'salary'=> $request->salary,
            'tin_no'=> $request->tin_no,
            'cash_allowance' => $request->cash_allowance,
            'accomadation'=> $request->accomadation,
            'vehicle_element' => $request->vehicle_element,
            'benefits'=> $request->benefits,
            'social_security'=> $request->social_security,
            'deductable_relief'=> $request->deductable_relief,
            'tax_paid_GRA'=> $request->tax_paid_GRA,
            'tax_deductable'=> $request->tax_deductable,
            'total_emoluments'=> $emoluments,
            'net_taxable_pay'=> $taxable_pay,
            'month' => $month,
            'team_id' => auth()->user()->currentTeam->id,
        ]);

        if($request->next){
            return redirect()->route('payroll.create')->withMessage('Added.');
           }else{
        //Response Message
        return redirect()->route('payroll.index')->withMessage('Added.');
           }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
