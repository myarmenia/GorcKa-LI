<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategoryTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sub_category_translations')->insert([
            [
                'id' => 1,
                'sub_category_id' => 1,
                'lang' => 'am',
                'name' => 'Համակարգչային օգնություն',
                'status' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 2,
                'sub_category_id' => 1,
                'lang' => 'ru',
                'name' => 'Компьютерная помощь',
                'status' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 3,
                'sub_category_id' => 1,
                'lang' => 'en',
                'name' => 'Computer help',
                'status' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 4,
                'sub_category_id' => 2,
                'lang' => 'am',
                'name' => 'Ծրագրային ապահովման մշակում',
                'status' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 5,
                'sub_category_id' => 2,
                'lang' => 'ru',
                'name' => 'Разработка программного обеспечения',
                'status' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 6,
                'sub_category_id' => 2,
                'lang' => 'en',
                'name' => 'Software development',
                'status' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 7,
                'sub_category_id' => 3,
                'lang' => 'am',
                'name' => 'Անվադողերի սպասարկում',
                'status' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 8,
                'sub_category_id' => 3,
                'lang' => 'ru',
                'name' => 'Шиномонтаж',
                'status' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 9,
                'sub_category_id' => 3,
                'lang' => 'en',
                'name' => 'Tire service',
                'status' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 10,
                'sub_category_id' => 4,
                'lang' => 'am',
                'name' => 'Թափքի վերանորոգում',
                'status' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 11,
                'sub_category_id' => 4,
                'lang' => 'ru',
                'name' => 'Ремонт кузова',
                'status' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 12,
                'sub_category_id' => 4,
                'lang' => 'en',
                'name' => 'Body repair',
                'status' => 1,
                'created_at' => null,
                'updated_at' => null
            ]
        ]);
    }
}
