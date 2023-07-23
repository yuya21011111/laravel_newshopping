<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('primary_categories')->insert([
            [
                'name' => 'プレイステーション',
                'sort_order' => 1
            ],
            [
                'name' => 'Switch',
                'sort_order' => 2
            ],
            [
                'name' => 'Xbox',
                'sort_order' => 3
            ],
        ]);

        DB::table('secondary_categories')->insert([
            [
                'name' => 'アンチャーテッドシリーズ',
                'sort_order' => 1,
                'primary_category_id' => 1
            ],
            [
                'name' => 'FFシリーズ',
                'sort_order' => 2,
                'primary_category_id' => 1
            ],
            [
                'name' => 'ホライゾンシリーズ',
                'sort_order' => 3,
                'primary_category_id' => 1
            ],

            [
                'name' => 'マリオシリーズ',
                'sort_order' => 4,
                'primary_category_id' => 2
            ],
            [
                'name' => 'ゼルダシリーズ',
                'sort_order' => 5,
                'primary_category_id' => 2
            ],
            [
                'name' => 'カービィシリーズ',
                'sort_order' => 6,
                'primary_category_id' => 2
            ],

            [
                'name' => 'ヘイローシリーズ',
                'sort_order' => 7,
                'primary_category_id' => 3
            ],
            [
                'name' => 'GoWシリーズ',
                'sort_order' => 8,
                'primary_category_id' => 3
            ],
        ]);
    }
}
