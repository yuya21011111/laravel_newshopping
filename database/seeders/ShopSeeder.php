<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dateTime = Carbon::now();
        DB::table('shops')->insert([
            [
                'owner_id' => 1,
                'name' => 'ここに店名が入ります',
                'information' => 'ここにお店の情報が入ります。ここにお店の情報が入ります。ここにお店の情報が入ります',
                'filename' => 'test1.jpg',
                'is_selling' => true,
                'created_at' =>  $dateTime,
            ],
            [
                'owner_id' => 2,
                'name' => 'ここに店名が入ります2',
                'information' => 'ここにお店の情報が入ります。ここにお店の情報が入ります。ここにお店の情報が入ります2',
                'filename' => 'test2.jpg',
                'is_selling' => true,
                'created_at' =>  $dateTime,
            ],
            [
                'owner_id' => 3,
                'name' => 'ここに店名が入ります3',
                'information' => 'ここにお店の情報が入ります。ここにお店の情報が入ります。ここにお店の情報が入ります3',
                'filename' => 'test3.jpg',
                'is_selling' => true,
                'created_at' =>  $dateTime,
            ],
        ]);
    }
}
