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
            [
                'name' => 'Admin',
                'email' => 'duru.informacija@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 1
            ],
            [
                'name' => 'Manager',
                'email' => 'duru.informacija2@gmail.com',
                'password' => Hash::make('password2'),
                'role_id' => 2
            ], 
            [
                'name' => 'Production Manager',
                'email' => 'duru.informacija3@gmail.com',
                'password' => Hash::make('password3'),
                'role_id' => 3
            ], 
        ]);
    }
}
