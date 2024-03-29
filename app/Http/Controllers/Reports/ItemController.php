<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use App\Models\Title;
use App\Models\Item;
use App\Models\CompanyAccount;
use App\Models\Company;
use App\Services\ReportService;
use Illuminate\Support\Facades\DB;

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
        $company = Company::find(auth()->user()->current_team_id);
        $accounts = CompanyAccount::where('company_id',auth()->user()->current_team_id)->get();
        $title = Title::latest()->first();

        return view('dashboard.items',compact('accounts','title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        //Authenticated User
    $user = auth()->user();
    $title = Title::latest()->first();
    $type = $title->type;
    $titleId =  $title->id;

    DB::transaction(function () use ($request,$user,$type,$titleId): void {
    //Get Total
    $total = $request->qty * $request->price;

    Item::create([
        'item_name' => $request->item_name,
        'team_id' => $user->currentTeam->id,
        'qty'=> $request->qty,
        'price'=> $request->price,
        'acc_dr'=> $request->acc_dr,
        'acc_cr'=> $request->acc_cr,
        'total' => $total,
        'title_id'=> $titleId,
        'discount' => $request->discount,
    ]);

    //Store Transactions
    $this->reportService->storeTransaction($request,$type,$total);
 });

        if($request->next){
         return redirect()->route('item.create')->withMessage('Item Added.');
        }else{

        return ($type == 'income') ? redirect()->route('sales.index'):redirect()->route('purchases.index')->withMessage('Item Added.');
        }


    }


}
