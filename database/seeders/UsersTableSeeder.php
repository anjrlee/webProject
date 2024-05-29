<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Insert admin user
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'gender' => '不願意透露',
            'department' => 'IT',
            'bio' => 'Administrator',
        ]);

        // Insert password for admin user
        $userId = DB::table('users')->where('email', 'admin@example.com')->first()->id;
        DB::table('psw')->insert([
            'user_id' => $userId,
            'password' => Hash::make('adminpassword'), // Replace 'adminpassword' with your desired password
        ]);
    }
}
