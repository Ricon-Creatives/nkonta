<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Industry;
use App\Models\Account;


class IndustryController extends Controller
{

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $industries = Industry::withCount('accounts')->orderBy('name','asc')->get();

        return view('admin.industries.index',compact('industries'));

    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts = Account::get();
        return view('admin.industries.create',compact('accounts'));
    }

      /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $industry = Industry::find($id);
        $accounts = Account::orderBy('code')->get();
        return view('admin.industries.edit',compact('industry','accounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $industry = new Industry;

        $industry->name = $request->name;
        $industry->code = $request->code;
        $industry->save();

        $industry->accounts()->attach($request->accounts);

        return redirect()->route('industry.index');

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
        $industry = Industry::find($id);

        $industry->update($request->all());
        $industry->save();

        $industry->accounts()->attach($request->accounts);

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $industry = Industry::find($id);
        // Detach all accounts from the industry...
         $industry->accounts()->detach();
          // Delete all accounts from the industry...
         $industry->delete();

        return redirect()->route('industry.index');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request, $id)
    {
        //dd($request);
         $industry = Industry::find($request->industryId);
        // Detach all accounts from the industry...
         $industry->accounts()->detach($id);

        return redirect()->back();
    }

}
