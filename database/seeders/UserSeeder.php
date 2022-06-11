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
       DB::table('users')->insert([
            'name' => 'nkonta',
            'username' => 'nkonta11',
            'email' => 'nkonta@gmail.com',
            'phone' => '0504628244',
            'password' => Hash::make('nkonta_admin1'),
        ]);

    }
}
