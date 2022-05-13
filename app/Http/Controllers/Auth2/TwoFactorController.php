<?php

namespace App\Http\Controllers\Auth2;

use App\Http\Controllers\Controller;
use App\Traits\SendSms;
use Illuminate\Http\Request;


class TwoFactorController extends Controller
{
    use  SendSms;

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = auth()->user();

        //generate
        $user->generateTwoFactorCode();
        //send sms
        $this->sendSmS($user->phone,$user->token);

        return view('2FA.verify');
    }

    public function store(Request $request)
    {
        $request->validate([
            'token' => 'required',
        ]);

        $user = auth()->user();

        if($request->input('token') == $user->token)
        {
            $user->resetTwoFactorCode();

            return redirect()->route('home');
        }

        return redirect()->back()
            ->withMessage('The code you have entered does not match');
    }

    public function resend()
    {
        $user = auth()->user();
        $user->generateTwoFactorCode();
        $this->sendSmS($user->phone,$user->token);

        return view('2FA.verify')->withMessage('The code has been sent again');
    }
}
