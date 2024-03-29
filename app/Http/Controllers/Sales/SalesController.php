<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Title;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $sales = Title::where('type','income')->latest()->paginate(10);

        return view('dashboard.sales.index',compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.sales.create');
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
            'due_date' => ['required'],
            'name' => ['required'],
            'vat' => ['required'],
            'contact_no' => ['required'],
            'contact_person' => ['required'],
            'address' => ['required'],
            'type' => ['required'],
        ]);

        Title::create([
            'due_date' => $request->due_date,
            'name' => $request->name,
            'vat' => $request->vat,
            'contact_no' => $request->contact_no,
            'contact_person' => $request->contact_person,
            'address' => $request->address,
            'type' => $request->type,
            'team_id' => auth()->user()->currentTeam->id,
        ]);

        //dd($title);
        return redirect()->route('item.create')->withMessage('Customer Added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trade = Title::find($id);
        return view('dashboard.reports.invoice' ,compact('trade'));
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
