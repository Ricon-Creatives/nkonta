<?php
namespace App\Services;

use App\Models\Total;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class ReportService
{

    public function storeTotals($transactions)
    {

        $user =  auth()->user();

        foreach ($transactions as $input) {

            //AcountId-amount-date
            $slug = Str::slug($input->account_id.$input->amount.Carbon::today()->format('d-m-Y'));

            #Find all transaction with same type and account_id on the same day
            $account = Total::where('account_id',$input->account_id)->where('type',$input->type)
            ->whereDate('created_at',Carbon::today())
            ->exists();

            if ($account) {
            $transaction = Total::where('account_id',$input->account_id)->where('type',$input->type)
            ->whereDate('created_at',Carbon::today())
            ->get();
                #Sum amount column and merge
                foreach($transaction as &$acc) {
              $transaction->toQuery()->update(['amount' => $acc['amount'] += $input->amount]);
          }
                #update value

        } else {
            #Store value
            $data = Total::create([
                'account_id'=> $input->account_id,
                'team_id' =>auth()->user()->currentTeam->id,
                'type'=> $input->type,
                'amount' => $input->amount,
                'slug'=> $slug,
            ]);

            $data->save();
        }

        }
    }

    public function storeTransaction($request,$type,$total)
    {

        $date = Carbon::today();
        $reference_no =  mt_rand(10000, 99999);

        $data = Transaction::create([
            'date'=> $date,
            'team_id' =>auth()->user()->currentTeam->id,
            'amount' => $total,
            'account_id'=> $request->acc_dr,
            'category_id'=> $request->acc_cr,
           // 'description_to_debit'=> $request->description_to_debit,
            'type'=> ($type == 'expense') ? "debit" : "credit",
            'reference_no' => $reference_no,
            'slug' => $request->slug
        ]);

        //if type = income
        $copy = $data->replicate()->fill(
            [
                'date'=> $date,
                'amount' => $total,
                'account_id'=> $request->acc_cr,
                'category_id'=> $request->acc_dr,
                //'description_to_credit'=> $request->description_to_credit,
                'type'=> ($type == 'expense') ? "credit" : "debit" ,
                'reference_no' => $reference_no,
                'slug' => $request->slug
            ]
        );

        $copy->save();
         //($copy);

         $transactions = [$data,$copy];

         $this->storeTotals($transactions);
    }

}


?>
