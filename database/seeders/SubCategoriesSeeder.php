<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sub_categories')->insert([
            [
                'id' => 1,
                'category_id' => 1,
                'status' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 2,
                'category_id' => 1,
                'status' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 3,
                'category_id' => 2,
                'status' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 4,
                'category_id' => 2,
                'status' => 1,
                'created_at' => null,
                'updated_at' => null
            ]
        ]);
    }
}
