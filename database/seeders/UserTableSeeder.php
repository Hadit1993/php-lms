<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     DB::table('users')-> insert([
        [
            'name' => 'Hadi Tahmasbi',
            'username' => 'hadit1993',
            'email' => 'hadit1993@gmail.com',
            'password' => Hash::make("123456"),
            'role' => 'admin',
        ],
        [
            'name' => 'Farzad Golanbari',
            'username' => 'fagol',
            'email' => 'fagol@gmail.com',
            'password' => Hash::make("123456"),
            'role' => 'instructor',
        ],

        [
            'name' => 'Fardin Saadati',
            'username' => 'fasa',
            'email' => 'fasa@gmail.com',
            'password' => Hash::make("123456"),
            'role' => 'user',
        ],


        ]);
    }
}
