<?php

namespace Database\Seeders;

use App\Models\SubCategoryTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategoryTranslationsSeeder1 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'sub_category_id' => 1,
                'lang' => 'am',
                'name' => 'Համակարգչային օգնություն'
            ],
            [
                'sub_category_id' => 1,
                'lang' => 'ru',
                'name' => 'Компьютерная помощь'
            ],
            [
                'sub_category_id' => 1,
                'lang' => 'en',
                'name' => 'Computer help'
            ],
            [
                'sub_category_id' => 2,
                'lang' => 'am',
                'name' => 'Ծրագրային ապահովման մշակում'
            ],
            [
                'sub_category_id' => 2,
                'lang' => 'ru',
                'name' => 'Разработка программного обеспечения'
            ],
            [
                'sub_category_id' => 2,
                'lang' => 'en',
                'name' => 'Software development'
            ],
            [
                'sub_category_id' => 3,
                'lang' => 'am',
                'name' => 'Անվադողերի սպասարկում'
            ],
            [
                'sub_category_id' => 3,
                'lang' => 'ru',
                'name' => 'Шиномонтаж'
            ],
            [
                'sub_category_id' => 3,
                'lang' => 'en',
                'name' => 'Tire service'
            ],
            [
                'sub_category_id' => 4,
                'lang' => 'am',
                'name' => 'Թափքի վերանորոգում'
            ],
            [
                'sub_category_id' => 4,
                'lang' => 'ru',
                'name' => 'Ремонт кузова'
            ],
            [
                'sub_category_id' => 4,
                'lang' => 'en',
                'name' => 'Body repair'
            ]
        ];

        foreach ($data as $item) {
            SubCategoryTranslation::updateOrCreate(['sub_category_id' => $item['sub_category_id'], 'name' => $item['name']], $item);
        }

    }
}
