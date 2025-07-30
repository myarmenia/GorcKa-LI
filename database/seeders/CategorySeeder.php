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
                'icon' => 'it'
            ],
            [
                'id' => 2,
                'color' => 'blue',
                'icon' => 'car'
            ],
            [
                'id' => 3,
                'color' => 'violet',
                'icon' => 'cargon'
            ],
            [
                'id' => 4,
                'color' => 'pink',
                'icon' => 'veterninarian'
            ],
            [
                'id' => 5,
                'color' => 'yellow',
                'icon' => 'repair'
            ],
            [
                'id' => 6,
                'color' => 'sky',
                'icon' => 'cleaning'
            ],
            [
                'id' => 7,
                'color' => 'green',
                'icon' => 'accounting'
            ],
            [
                'id' => 8,
                'color' => 'red',
                'icon' => 'design'
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
            ],
            [
                'id' => 16,
                'color' => 'sky',
                'icon' => ''
            ],
            [
                'id' => 17,
                'color' => 'sky',
                'icon' => ''
            ]


        ];

        Category::upsert($categories, ['id']);

    }
}
