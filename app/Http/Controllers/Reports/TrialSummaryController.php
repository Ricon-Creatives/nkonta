<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use DB;
use Illuminate\Support\Collection;

class TrialSummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    $companyId = auth()->user()->currentTeam->id;

    $transactions =  DB::table('transactions')->where('transactions.team_id',$companyId)
    ->join('accounts', 'transactions.account_id', '=', 'accounts.id')
    ->whereDate('transactions.created_at',Carbon::today())
    ->select('accounts.code',DB::raw('SUM(amount) as amount,transactions.type,accounts.name,accounts.group_by_code'))
    ->groupBy('accounts.group_by_code','accounts.code','transactions.type','accounts.name')
    ->get();

    $exists_array = [];
        foreach ($transactions as $current_key => $current_array) {
        //echo "current key: $current_key<br>";
        foreach ($transactions as $search_key => $search_array) {
            if ($search_array->code == $current_array->code) {
                if ($search_key != $current_key) {
               array_push($exists_array,$search_array);
                }
            }
        }
        }

        function diffArray($arr1, $arr2) {
            $result = [];
            for ($i=0; $i < count($arr1) ; $i++) {
                for ($j=0; $j <  count($arr1); $j++) {
                    # code...
                }
            }
            foreach($arr1 as &$value1) {
                foreach($arr2 as &$value2) {
                    if ($value1->code == $value2->code && $value1->type != $value2->type) {
                        if ($value1->type == 'debit') {
                            if (@$value1->checked != 1  || $value2->checked != 1) {
                                $minus = $value1->amount - $value2->amount;
                                $value1->type =   ($minus>0) ? 'debit' : 'credit';
                                $value1->amount = abs($minus);
                                $value1->checked = 1;
                                $value2->checked = 1;
                                \array_push($result,$value1);
                            }

                        } else{
                            if (@$value1->checked != 1 || $value2->checked != 1) {
                            $minus = $value2->amount - $value1->amount;
                            $value1->type =  ($minus>0) ? 'debit' : 'credit';
                            $value1->amount = abs($minus);
                            $value1->checked = 1;
                            $value2->checked = 1;
                            \array_push($result,$value1);
                            }
                        }
                    }
                }
            }
            return $result;
        }

        function trackMerge ($toMerge,$merger) {
            $result = [];
            foreach ($toMerge as $currentValue) {
                foreach ($merger as $compareValue) {
                    if ($compareValue->code == $currentValue->code) {
                       array_push($result,$compareValue);
                    }else{
                        array_push($result,$currentValue);
                    }
                }
                }
                return $result;
        }

        function unique_multidimensional_array($array, $key) {
            $temp_array = array();
            $i = 0;
            $key_array = array();

            foreach($array as $val) {
                if (!in_array($val->$key, $key_array)) {
                    $key_array[$i] = $val->$key;
                    $temp_array[$i] = $val;
                }else if (in_array($val->$key, $key_array)){
                    unset($temp_array[$i-1]);
                }
                $i++;
            }
            return $temp_array;
        }

        $resultArray = diffArray($exists_array,$exists_array);
        $uniqueArray = unique_multidimensional_array($transactions, 'code');
       $newTransactions =  array_merge($uniqueArray,$resultArray);

    //find transaction
    return view('dashboard.reports.summary', compact('newTransactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($transactions)
    {


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
