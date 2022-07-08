<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\PasswordUpdateRequest;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProfile()
    {
        return view('dashboard.profile.account');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPassword()
    {
        return view('dashboard.profile.password');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request)
    {
        $user = auth()->user();
        $user->update($request->all());

        return redirect()->back()->withMessage('Profile updated');
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(PasswordUpdateRequest $request)
    {
        $user = auth()->user();

         //if password not empty
         if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request['password'])]);
        }

        $user->update($request->all());

        return redirect()->route('profile.password')->withMessage('Password changed');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
