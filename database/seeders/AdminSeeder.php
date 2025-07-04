<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Untuk hashing password

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Test Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123123'), // Password di-hash agar aman
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}