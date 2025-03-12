<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category_translations')->insert([
            [
                'id' => 1,
                'category_id' => 1,
                'lang' => 'am',
                'name' => 'ՏՏ ծառայություններ',
                'status' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 2,
                'category_id' => 1,
                'lang' => 'ru',
                'name' => 'ИТ-услуги',
                'status' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 3,
                'category_id' => 1,
                'lang' => 'en',
                'name' => ' IT services',
                'status' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 4,
                'category_id' => 2,
                'lang' => 'am',
                'name' => 'Ավտոմեքենաների սպասարկում',
                'status' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 5,
                'category_id' => 2,
                'lang' => 'ru',
                'name' => 'Автосервис',
                'status' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 6,
                'category_id' => 2,
                'lang' => 'en',
                'name' => 'Car service',
                'status' => 1,
                'created_at' => null,
                'updated_at' => null
            ]
        ]);
    }
}
