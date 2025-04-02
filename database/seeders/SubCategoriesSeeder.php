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
                'category_id' => 1,
            ],
            [
                'id' => 4,
                'category_id' => 1,
            ],
            [
                'id' => 5,
                'category_id' => 1,
            ],
            [
                'id' => 6,
                'category_id' => 1,
            ],
            [
                'id' => 7,
                'category_id' => 1,
            ],
            [
                'id' => 8,
                'category_id' => 1,
            ],
            [
                'id' => 9,
                'category_id' => 1,
            ],
            [
                'id' => 10,
                'category_id' => 2,
            ],
            [
                'id' => 11,
                'category_id' => 2,
            ],
            [
                'id' => 12,
                'category_id' => 2,
            ],
            [
                'id' => 13,
                'category_id' => 2,
            ],
            [
                'id' => 14,
                'category_id' => 2,
            ],
            [
                'id' => 15,
                'category_id' => 2,
            ],
            [
                'id' => 16,
                'category_id' => 2,
            ],
            [
                'id' => 17,
                'category_id' => 2,
            ],
            [
                'id' => 18,
                'category_id' => 2,
            ],
            [
                'id' => 19,
                'category_id' => 2,
            ],
            [
                'id' => 20,
                'category_id' => 2,
            ],
            [
                'id' => 21,
                'category_id' => 2,
            ],
            [
                'id' => 22,
                'category_id' => 2,
            ],
            [
                'id' => 23,
                'category_id' => 2,
            ],
            [
                'id' => 24,
                'category_id' => 2,
            ],
            [
                'id' => 25,
                'category_id' => 3,
            ],
            [
                'id' => 26,
                'category_id' => 3,
            ],
            [
                'id' => 27,
                'category_id' => 3,
            ],
            [
                'id' => 28,
                'category_id' => 3,
            ],
            [
                'id' => 29,
                'category_id' => 3,
            ],
            [
                'id' => 30,
                'category_id' => 3,
            ],
            [
                'id' => 31,
                'category_id' => 3,
            ],
            [
                'id' => 32,
                'category_id' => 3,
            ],
            [
                'id' => 33,
                'category_id' => 3,
            ],
            [
                'id' => 34,
                'category_id' => 3,
            ],
            [
                'id' => 35,
                'category_id' => 3,
            ],
            [
                'id' => 36,
                'category_id' => 3,
            ],
            [
                'id' => 37,
                'category_id' => 3,
            ],

            [
                'id' => 38,
                'category_id' => 3,
            ],
            [
                'id' => 39,
                'category_id' => 4,
            ],
            [
                'id' => 40,
                'category_id' => 4,
            ],
            [
                'id' => 41,
                'category_id' => 4,
            ],
            [
                'id' => 42,
                'category_id' => 4,
            ],

            [
                'id' => 43,
                'category_id' => 4,
            ],
            [
                'id' => 44,
                'category_id' => 5,
            ],
            [
                'id' => 45,
                'category_id' => 5,
            ],
            [
                'id' => 46,
                'category_id' => 5,
            ],
            [
                'id' => 47,
                'category_id' => 5,
            ],
            [
                'id' => 48,
                'category_id' => 5,
            ],
            [
                'id' => 49,
                'category_id' => 5,
            ],
            [
                'id' => 50,
                'category_id' => 5,
            ],
            [
                'id' => 51,
                'category_id' => 5,
            ],
            [
                'id' => 52,
                'category_id' => 5,
            ],
            [
                'id' => 53,
                'category_id' => 5,
            ],
            [
                'id' => 54,
                'category_id' => 5,
            ],
            [
                'id' => 55,
                'category_id' => 5,
            ],
            [
                'id' => 56,
                'category_id' => 5,
            ],
            [
                'id' => 57,
                'category_id' => 5,
            ],
            [
                'id' => 58,
                'category_id' => 5,
            ],
            [
                'id' => 59,
                'category_id' => 5,
            ],
            [
                'id' => 60,
                'category_id' => 5,
            ],
            [
                'id' => 61,
                'category_id' => 5,
            ],
            [
                'id' => 62,
                'category_id' => 5,
            ],
            [
                'id' => 63,
                'category_id' => 5,
            ],
            [
                'id' => 64,
                'category_id' => 5,
            ],
            [
                'id' => 65,
                'category_id' => 5,
            ],
            [
                'id' => 66,
                'category_id' => 6,
            ],
            [
                'id' => 67,
                'category_id' => 6,
            ],
            [
                'id' => 68,
                'category_id' => 6,
            ],
            [
                'id' => 69,
                'category_id' => 6,
            ],
            [
                'id' => 70,
                'category_id' => 6,
            ],
            [
                'id' => 71,
                'category_id' => 6,
            ],
            [
                'id' => 72,
                'category_id' => 6,
            ],
            [
                'id' => 73,
                'category_id' => 6,
            ],
            [
                'id' => 74,
                'category_id' => 6,
            ],
            [
                'id' => 75,
                'category_id' => 6,
            ],
            [
                'id' => 76,
                'category_id' => 7,
            ],
            [
                'id' => 77,
                'category_id' => 7,
            ],
            [
                'id' => 78,
                'category_id' => 7,
            ],
            [
                'id' => 79,
                'category_id' => 7,
            ],
            [
                'id' => 80,
                'category_id' => 7,
            ],
            [
                'id' => 81,
                'category_id' => 7,
            ],
            [
                'id' => 82,
                'category_id' => 7,
            ],
            [
                'id' => 83,
                'category_id' => 7,
            ],
            [
                'id' => 84,
                'category_id' => 7,
            ],
            [
                'id' => 85,
                'category_id' => 7,
            ],
            [
                'id' => 86,
                'category_id' => 7,
            ],

            [
                'id' => 87,
                'category_id' => 8,
            ],
            [
                'id' => 88,
                'category_id' => 8,
            ],
            [
                'id' => 89,
                'category_id' => 8,
            ],
            [
                'id' => 90,
                'category_id' => 8,
            ],
            [
                'id' => 91,
                'category_id' => 8,
            ],
            [
                'id' => 92,
                'category_id' => 8,
            ],
            [
                'id' => 93,
                'category_id' => 8,
            ],
            [
                'id' => 94,
                'category_id' => 8,
            ],
            [
                'id' => 95,
                'category_id' => 8,
            ],
            [
                'id' => 96,
                'category_id' => 8,
            ],
            [
                'id' => 97,
                'category_id' => 8,
            ],
            [
                'id' => 98,
                'category_id' => 8,
            ],
            [
                'id' => 99,
                'category_id' => 8,
            ],
            [
                'id' => 100,
                'category_id' => 8,
            ],
            [
                'id' => 101,
                'category_id' => 8,
            ],
            [
                'id' => 102,
                'category_id' => 8,
            ],
            [
                'id' => 103,
                'category_id' => 8,
            ],

        ];

        SubCategory::upsert($data, ['id']);
    }
}
