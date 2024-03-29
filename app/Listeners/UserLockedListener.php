<?php

namespace App\Listeners;

use \Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;

class UserLockedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Lockout  $event
     * @return void
     */
    public function handle(Lockout $event)
    {
        ///dd($event);

        if ($user = User::where('email', $event->request->email)->first()) {

             $user->lockUser();
         }
    }
}
