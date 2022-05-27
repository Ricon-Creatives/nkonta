<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user =  DB::table('users')->insert([
            'name' => 'nkonta',
            'username' => 'nkonta11',
            'email' => 'nkonta@gmail.com',
            'password' => Hash::make('nkonta_admin1'),
        ]);

        $user->assignRole('Administrator');
    }
}
