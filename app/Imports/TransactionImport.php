<?php

namespace App\Imports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Carbon;



class TransactionImport implements ToCollection, WithHeadingRow
{
    private $matchedTransactions;
    private $unmatchedTransactions;

    private $month;

    public function setMonth($month)
    {
        $this->month = $month;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $user = auth()->user();
        $data = Transaction::with(['account'])->whereBelongsTo($user)->whereMonth('date', $this->month)->get();
        $bank_statement = $rows;
        $matched = collect(array());

        foreach ($bank_statement as $element) {
            $statementDate = Carbon::parse($element['date'])->format('Y-m-d');
            $statementAmount = number_format($element['amount'],2);
            //
            foreach ($data as $key => $value) {
                if ($statementDate == $value->date &&  $statementAmount == number_format($value->amount,2)) {
                    unset($data[$key]);
                    $matched->push($value);
                   // print("{$key}:{$value} <br>");
                }
            }
        }

        $this->matchedTransactions = $matched;
        $this->unmatchedTransactions = $data;

    }

   public function getMatched()
    {
        return $this->matchedTransactions;
    }

    public function getUnMatched()
    {
        return $this->unmatchedTransactions;
    }

}
