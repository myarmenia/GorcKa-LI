<?php

namespace Database\Seeders;

use App\Models\SubCategory;
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
        $data = [
            [
                'id' => 1,
                'category_id' => 1,
            ],
            [
                'id' => 2,
                'category_id' => 1,
            ],
            [
                'id' => 3,
                'category_id' => 2,
            ],
            [
                'id' => 4,
                'category_id' => 2,
            ],
            [
                'id' => 5,
                'category_id' => 2,
            ],
            [
                'id' => 6,
                'category_id' => 2,
            ],
            [
                'id' => 7,
                'category_id' => 3,
            ],
            [
                'id' => 8,
                'category_id' => 4,
            ],
            [
                'id' => 9,
                'category_id' => 4,
            ],
            [
                'id' => 10,
                'category_id' => 5,
            ]
        ];

        SubCategory::upsert($data, ['id']);
    }
}
