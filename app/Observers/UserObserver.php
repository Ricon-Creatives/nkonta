<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Company;
use App\Models\Industry;
use App\Models\CompanyAccount;
use Illuminate\Support\Facades\DB;


class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        DB::transaction(function () use ($user): void {
        if ($user->company_name) {
            $company   = new Company();
            $company->owner_id = $user->id;
            $company->name = $user->company_name;
            $company->industry_id = $user->industry;
            $company->save();

            // company attach alias
            $user->attachTeam($company);
            // Find accounts
            $industry = Industry::find($user->industry);
            $accounts = $industry->accounts;
            // assign accounts to company
            foreach ($accounts as $account) {
                CompanyAccount::create([
                 'company_id' => $company->id,
                 'code' => $account->code,
                 'name' =>$account->name,
                 'type' => $account->type,
                 'financial_statement' => $account->financial_statement,
                 'group_by_code' =>  $account->group_by_code
                ]);
            }
        }
       });
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
