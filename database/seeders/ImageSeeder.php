<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('images')->insert([
            [
                'owner_id' => 1,
               'filename' => 'test1.jpg',
               'title' => 'test',
            ],
            [
                'owner_id' => 1,
               'filename' => 'test2.jpg',
               'title' => 'test',
            ],
            [
                'owner_id' => 1,
               'filename' => 'test3.jpg',
               'title' => 'test',
            ],
            [
                'owner_id' => 1,
               'filename' => 'test4.jpg',
               'title' => 'test',
            ],
            [
                'owner_id' => 1,
               'filename' => 'test5.jpg',
               'title' => 'test',
            ],
            [
                'owner_id' => 1,
               'filename' => 'test6.jpg',
               'title' => 'test',
            ],
        ]);
    }
}
