<?php

namespace App\Imports;

use App\Models\Account;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class AccountsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $account = Account::updateOrCreate([
            'code' => $row['code'],
        ],[
            'code' => $row['code'],
            'name'  => $row['name'],
            'type' => $row['type'],
            'financial_statement' => $row['financial_statement'],
            'group_by_code' => $row['group_by_code'],
        ]);

        return $account;
    }
}
