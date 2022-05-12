<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Lockout;
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
     * @param  object  $event
     * @return void
     */
    public function handle(Lockout $event)
    {
       // var_dump($event);

       if ($user = User::where('email', $event->request->email)->first()) {

            //User::where('email', $event->request->email)->update(['locked' => now()]);
           // $user->lockUser();
           // $user->notify(new LockedOut);
        }
    }
}
