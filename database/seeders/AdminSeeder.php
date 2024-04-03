<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => "admin",
            'email' => "admin@gmail.com",
            'password' => Hash::make('admin'),
            'isAdmin' => True,
            'email_verified_at'=>date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => "admin1",
            'email' => "admin1@gmail.com",
            'password' => Hash::make('admin1'),
            'isAdmin' => True,
            'email_verified_at'=>date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => "admin2",
            'email' => "admin2@gmail.com",
            'password' => Hash::make('admin2'),
            'isAdmin' => True,
            'email_verified_at'=>date('Y-m-d H:i:s'),
        ]);
    }
}
