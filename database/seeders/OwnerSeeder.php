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
        ]);
    }
}
