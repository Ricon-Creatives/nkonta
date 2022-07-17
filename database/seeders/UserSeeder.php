<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('users')->insert([
            'name' => 'nkonta',
            'username' => 'nkonta11',
            'email' => 'nkonta@gmail.com',
            'company_name' => 'Nkonta',
            'phone' => '0504628244',
            'password' => Hash::make('nkonta_admin1'),
        ]);

        //
         $user = User::where('email','nkonta@gmail.com')->first();
         $team    = new Company();
            $team->owner_id = $user->id;
            $team->name = $user->company_name;
            $team->save();

            // team attach alias
            $user->attachTeam($team);

    }
}
