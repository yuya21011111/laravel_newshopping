<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dateTime = Carbon::now();
        DB::table('owners')->insert([
        [
            'name' => 'test1',
            'email' => 'test1@test.com',
            'password' => Hash::make('password123'),
            'created_at' =>  $dateTime,
        ],
        [
            'name' => 'test2',
            'email' => 'test2@test.com',
            'password' => Hash::make('password123'),
            'created_at' =>  $dateTime ,
        ],
        [
            'name' => 'test3',
            'email' => 'test3@test.com',
            'password' => Hash::make('password123'),
            'created_at' =>  $dateTime,
        ],
        [
            'name' => 'test4',
            'email' => 'test4@test.com',
            'password' => Hash::make('password123'),
            'created_at' =>  $dateTime,
        ],
        [
            'name' => 'test5',
            'email' => 'test5@test.com',
            'password' => Hash::make('password123'),
            'created_at' =>  $dateTime,
        ],
        [
            'name' => 'test6',
            'email' => 'test6@test.com',
            'password' => Hash::make('password123'),
            'created_at' =>  $dateTime,
        ],
        [
            'name' => 'test7',
            'email' => 'test7@test.com',
            'password' => Hash::make('password123'),
            'created_at' =>  $dateTime,
        ],
        ]);
    }
}
