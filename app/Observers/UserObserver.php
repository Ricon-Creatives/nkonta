<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Company;
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
        DB::transaction(function () use ($request): void {
        if ($user->company_name) {
            $team   = new Company();
            $team->owner_id = $user->id;
            $team->name = $user->company_name;
            $team->industry_id = $user->industry;
            $team->save();

            // team attach alias
            $user->attachTeam($team);
            # code...
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
