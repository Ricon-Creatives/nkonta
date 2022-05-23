<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Title;
use App\Services\ReportService;
use Illuminate\Support\Carbon;

class ItemController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $accounts = Account::get();
        $title = Title::whereBelongsTo($user)->latest()->first();

        return view('dashboard.items',compact('accounts','title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $user = auth()->user();
        $title = Title::whereBelongsTo($user)->latest()->first();

         $request->validate([
            'item_no' => ['required'],
            'item_name' => ['required'],
            'qty' => ['required'],
            'discount' => '',
            'price' => ['required'],
            'acc_dr' => ['required'],
            'acc_cr' => ['required'],
            'total' => ['required'],
        ]);

        auth()->user()->items()->create([
            'item_no'=> $request->item_no,
            'item_name' => $request->item_name,
            'qty'=> $request->qty,
            'price'=> $request->price,
            'acc_dr'=> $request->acc_dr,
            'acc_cr'=> $request->acc_cr,
            'title_id'=> $title->id,
            'total' => $request->total,
            'discount' => $request->discount,
        ]);

        $type = $title->type;
        $this->reportService->storeTransaction($request, $type);

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
