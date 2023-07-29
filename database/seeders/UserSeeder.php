<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dateTime = Carbon::now();
        DB::table('users')->insert([
            [
                'name' => 'test1',
                'email' => 'test1@test.com',
                'password' => Hash::make('password123'),
                'post' => '0011000',
                'addres' => '東京都板橋区１−１１',
                'birthday' => '1990-01-11',
                'created_at' => $dateTime
            ],
            [
                'name' => 'test2',
                'email' => 'test2@test.com',
                'password' => Hash::make('password123'),
                'post' => '0011000',
                'addres' => '東京都板橋区１−１１',
                'birthday' => '1990-01-11',
                'created_at' => $dateTime
            ],
            [
                'name' => 'test3',
                'email' => 'test3@test.com',
                'password' => Hash::make('password123'),
                'post' => '0011000',
                'addres' => '東京都板橋区１−１１',
                'birthday' => '1990-01-11',
                'created_at' => $dateTime
            ],
        ]);
    }
}
