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
            ['id' => 1, 'status' => '1'],
            ['id' => 2, 'status' => '1'],
            ['id' => 3, 'status' => '1'],
            ['id' => 4, 'status' => '1'],
            ['id' => 5, 'status' => '1'],
            ['id' => 6, 'status' => '1'],
            ['id' => 7, 'status' => '1'],
            ['id' => 8, 'status' => '1'],
            ['id' => 9, 'status' => '1'],
            ['id' => 10, 'status' => '1'],
            ['id' => 11, 'status' => '1'],
            ['id' => 12, 'status' => '1'],
            ['id' => 13, 'status' => '1'],
            ['id' => 14, 'status' => '1'],
            ['id' => 15, 'status' => '1'],
            ['id' => 16, 'status' => '1'],

        ];

        foreach ($categories as $item) {
            Category::create($item);
        }
    }
}
