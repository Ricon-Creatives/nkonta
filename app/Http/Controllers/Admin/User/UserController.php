<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           $users = User::paginate(10);

        return view('admin.users.index',compact('users'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::get();

        return view('admin.users.edit', compact('user','roles'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
           $user = User::find($id);
        //if password not empty
        if(empty($request->password) ){
            $user->update($request->except('password'));
         }else{
            $request->merge(['password' => Hash::make($request['password'])]);
            $user->update($request->all());
         }

         if(!empty($request->role) ){
         $user->assignRole($request->role);
         }

        return redirect()->route('user.index')->withMessage('Updated');
    }
}
