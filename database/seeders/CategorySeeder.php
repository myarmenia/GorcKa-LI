<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'id' => 1,
                'color' => 'green',
                'icon' => ''
            ],
            [
                'id' => 2,
                'color' => 'blue',
                'icon' => ''
            ],
            [
                'id' => 3,
                'color' => 'violet',
                'icon' => ''
            ],
            [
                'id' => 4,
                'color' => 'pink',
                'icon' => ''
            ],
            [
                'id' => 5,
                'color' => 'yellow',
                'icon' => ''
            ],
            [
                'id' => 6,
                'color' => 'sky',
                'icon' => ''
            ],
            [
                'id' => 7,
                'color' => 'green',
                'icon' => ''
            ],
            [
                'id' => 8,
                'color' => 'red',
                'icon' => ''
            ],
            [
                'id' => 9,
                'color' => 'violet',
                'icon' => ''
            ],
            [
                'id' => 10,
                'color' => 'sky',
                'icon' => ''
            ],
            [
                'id' => 11,
                'color' => 'blue',
                'icon' => ''
            ],
            [
                'id' => 12,
                'color' => 'yellow',
                'icon' => ''
            ],
            [
                'id' => 13,
                'color' => 'green',
                'icon' => ''
            ],
            [
                'id' => 14,
                'color' => 'blue',
                'icon' => ''
            ],
            [
                'id' => 15,
                'color' => 'sky',
                'icon' => ''
            ]


        ];

        Category::upsert($categories, ['id']);

    }
}
