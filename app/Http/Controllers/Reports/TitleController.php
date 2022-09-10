<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Title;


class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'due_date' => ['required'],
            'name' => ['required'],
            'vat' => ['required'],
            'contact_no' => ['required'],
            'contact_person' => ['required'],
            'address' => ['required'],
            'type' => ['required'],
        ]);

        $title = auth()->user()->titles()->create($data);

        //dd($title);
        return redirect()->route('item.create');
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


}
