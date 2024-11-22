<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@mara.com',
            'password' => Hash::make('admin123'),
        ]);

        DB::table('users')->insert([
            'name' => 'operator1',
            'email' => 'operator1@mara.com',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'operator2',
            'email' => 'operator2@mara.com',
            'password' => Hash::make('password'),
        ]);
    }
}
