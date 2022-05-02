<?php
namespace App\Services;

use App\Models\Total;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;


class ReportService
{

    public function storeTotals($transactions)
    {

        $user =  auth()->user();

        foreach ($transactions as $input) {

            //acountId-amount-date
            $slug = Str::slug($input->account_id.$input->amount.Carbon::today()->format('d-m-Y'));

            #find all transaction with same type and account_id on the same day
            $account = Total::whereBelongsTo($user)->where('account_id',$input->account_id)->where('type',$input->type)
            ->whereDate('created_at',Carbon::today())
            ->exists();

            if ($account) {
            $transaction = Total::whereBelongsTo($user)->where('account_id',$input->account_id)->where('type',$input->type)
            ->whereDate('created_at',Carbon::today())
            ->get();
                #sum amount column and merge
                foreach($transaction as &$acc) {

              $transaction->toQuery()->update(['amount' => $acc['amount'] += $input->amount]);
          }
                #update value

        } else {
            #store value
            //dd($input);
            $data = auth()->user()->totals()->create([
                'account_id'=> $input->account_id,
                'type'=> $input->type,
                'amount' => $input->amount,
                'slug'=> $slug,
            ]);

            $data->save();
        }



        }
    }

}


?>
