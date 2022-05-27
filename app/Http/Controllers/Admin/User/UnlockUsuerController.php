<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UnlockUsuerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        //dd($request);
        $user = User::find($id);

        if($request->locked == 'locked'){

        $user->update(['locked' => now()]);

        }else if($request->locked == 'active'){
            $user->update(['locked' => null]);
        }

        return back();
    }
}
