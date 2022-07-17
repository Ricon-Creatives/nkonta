<?php

namespace App\Http\Controllers\Purchases;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Title;
use App\Models\Item;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $purchases = Title::where('type','expense')->latest()->paginate(10);

        return view('dashboard.purchases.index',compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.purchases.create');
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
