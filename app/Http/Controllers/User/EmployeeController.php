<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Mpociot\Teamwork\Facades\Teamwork;
use Mpociot\Teamwork\TeamInvite;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendInvite;
use Illuminate\Support\Str;
use App\Models\User;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user =  auth()->user();
        return view('dashboard.employee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $this->authorize('manage',$user);
        $roles = Role::get();

        return view('dashboard.employee.create', compact('roles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('manage',$user);

       // $user =  auth()->user();
        $team = auth()->user()->currentTeam;
         $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required'],
            'role' => ['required'],
        ]);

       $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => '233'.intval($request->phone),
            'password' => Hash::make('password123')
            //,Str::random(8)
        ]);

        //Assign Role
        $user->assignRole($request->role);
        //Assign Team
        $user->attachTeam($team);

        $details = ['from' => $team->name,'type' => 'invite'];
        // Send email to user / let them know that they got invited
        Notification::send($user, new SendInvite($details));

        //$user->company()->attach($company->id);

        return redirect()->route('employee.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = User::find($id);
        $roles = Role::get();
        return view('dashboard.employee.edit', compact('employee','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request);
        $employee = User::find($id);
        //Remove prevoius roles
        foreach ($employee->roles as $role) {
            $employee->removeRole($role);
       }
       //Assing new role
        $employee->assignRole($request->role);

        return redirect()->route('employee.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,User $user)
    {
        $this->authorize('manage',$user);

        $employee = User::find($id);
        //Find team
        $team = $employee->currentTeam;
        //Detach user from team
        $employee->detachTeam($team);

        return redirect()->route('employee.index');
    }
}
