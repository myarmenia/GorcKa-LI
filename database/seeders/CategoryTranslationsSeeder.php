<?php

namespace Database\Seeders;

use App\Models\CategoryTranslation;
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


        $data = [
            [
                'category_id' => 1,
                'lang' => 'am',
                'name' => 'ՏՏ ծառայություններ',
            ],
            [
                'category_id' => 1,
                'lang' => 'ru',
                'name' => 'ИТ-услуги',
            ],
            [
                'category_id' => 1,
                'lang' => 'en',
                'name' => 'IT services',
            ],
            [
                'category_id' => 2,
                'lang' => 'am',
                'name' => 'Ավտոմեքենաների սպասարկում',
            ],
            [
                'category_id' => 2,
                'lang' => 'ru',
                'name' => 'Автосервис',
            ],
            [
                'category_id' => 2,
                'lang' => 'en',
                'name' => 'Car service',
            ],
            [
                'category_id' => 3,
                'lang' => 'am',
                'name' => 'Բեռնափոխադրումներ',
            ],
            [
                'category_id' => 3,
                'lang' => 'ru',
                'name' => 'Грузоперевозки',
            ],
            [
                'category_id' => 3,
                'lang' => 'en',
                'name' => 'Cargo transportation',
            ],
            [
                'category_id' => 4,
                'lang' => 'am',
                'name' => 'Անասնաբույժ',
            ],
            [
                'category_id' => 4,
                'lang' => 'ru',
                'name' => 'Ветеринар',
            ],
            [
                'category_id' => 4,
                'lang' => 'en',
                'name' => 'Veterinarian',
            ],
            [
                'category_id' => 5,

                'lang' => 'am',
                'name' => 'Վերանորոգում',
            ],
            [
                'category_id' => 5,
                'lang' => 'ru',
                'name' => 'Ремонтные работы',
            ],
            [
                'category_id' => 5,
                'lang' => 'en',
                'name' => 'Repair',
            ],
            [
                'category_id' => 6,
                'lang' => 'am',
                'name' => 'Cat-6-am',
            ],
            [
                'category_id' => 6,
                'lang' => 'ru',
                'name' => 'Cat-6-ru',
            ],
            [
                'category_id' => 6,
                'lang' => 'en',
                'name' => 'Cat-6-en',
            ],
            [
                'category_id' => 7,
                'lang' => 'am',
                'name' => 'Cat-7-am',
            ],
            [
                'category_id' => 7,
                'lang' => 'ru',
                'name' => 'Cat-7-ru',
            ],
            [
                'category_id' => 7,
                'lang' => 'en',
                'name' => 'Cat-7-en',
            ],
            [
                'category_id' => 8,
                'lang' => 'am',
                'name' => 'Cat-8-am',
            ],
            [
                'category_id' => 8,
                'lang' => 'ru',
                'name' => 'Cat-8-ru',
            ],
            [
                'category_id' => 8,
                'lang' => 'en',
                'name' => 'Cat-8-en',
            ],
            [
                'category_id' => 9,
                'lang' => 'am',
                'name' => 'Cat-9-am',
            ],
            [
                'category_id' => 9,
                'lang' => 'ru',
                'name' => 'Cat-9-ru',
            ],
            [
                'category_id' => 9,
                'lang' => 'en',
                'name' => 'Cat-9-en',
            ],
            [
                'category_id' => 10,
                'lang' => 'am',
                'name' => 'Cat-10-am',
            ],
            [
                'category_id' => 10,
                'lang' => 'ru',
                'name' => 'Cat-10-ru',
            ],
            [
                'category_id' => 10,
                'lang' => 'en',
                'name' => 'Cat-10-en',
            ],

        ];

        foreach ($data as $item) {
            CategoryTranslation::updateOrCreate(['category_id' => $item['category_id'], 'name' => $item['name']], $item);
        }

    }
}
