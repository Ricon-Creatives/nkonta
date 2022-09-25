<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\CompanyAccount;
use DB;

class CompanyAccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = CompanyAccount::where('company_id',auth()->user()->current_team_id)
        ->orderBy('type','asc')->paginate(15);

        return view('dashboard.accounts.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.accounts.create');
    }


    public function account()
    {
        $accounts = CompanyAccount::where('company_id',auth()->user()->current_team_id)->get();
        return $accounts;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'type' => 'required',
            'financial_statement' => 'nullable'
        ]);

        CompanyAccount::where('company_id',auth()->user()->current_team_id)->create([
            'company_id' => auth()->user()->current_team_id,
            'name' => $request->name,
            'code' => $request->code,
            'type' => $request->type,
            'financial_statement' => $request->financial_statement
        ]);

        return redirect()->route('company-accounts.index')
        ->withMessage('New accounts added.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = CompanyAccount::find($id);

        return view('dashboard.accounts.edit',compact('account'));
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
        $user = auth()->user();
        $company = Company::find($user->current_team_id);
        $accounts = CompanyAccount::where('id',$id)->where('company_id',$user->current_team_id)
           ->update($request->except(['_method','_token']));

        return redirect()->route('company-accounts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

     CompanyAccount::where('id',$id)->delete();

     return redirect()->route('company-accounts.index')->withMessage('Account deleted successfully.');
    }
}
