<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Monica Sayon',
            'email' => 'testuser1@example.com',
            'password' => Hash::make('monica123'),
        ]);

        DB::table('users')->insert([
            'name' => 'Jessica Paltingca',
            'email' => 'testuser2@example.com',
            'password' => Hash::make('jessica123'),
        ]);

        DB::table('users')->insert([
            'name' => 'Bryx Jacob Frias',
            'email' => 'testuser3@example.com',
            'password' => Hash::make('bryx123'),
        ]);

        DB::table('users')->insert([
            'name' => 'Princess Ericka Buyain',
            'email' => 'testuser4@example.com',
            'password' => Hash::make('princess123'),
        ]);

        DB::table('users')->insert([
            'name' => 'Sophia Tagapan',
            'email' => 'testuser5@example.com',
            'password' => Hash::make('sophia123'),
        ]);
    }
}