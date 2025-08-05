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
                'name' => 'Վերանորոգում և ներքին հարդարանք ',
            ],
            [
                'category_id' => 5,
                'lang' => 'ru',
                'name' => 'Ремонт и внутренняя отделка',
            ],
            [
                'category_id' => 5,
                'lang' => 'en',
                'name' => 'Renovation and interior decoration',
            ],
            [
                'category_id' => 6,
                'lang' => 'am',
                'name' => 'Մաքրում, ախտահանում',
            ],
            [
                'category_id' => 6,
                'lang' => 'ru',
                'name' => ' Уборка, дезинфекция',
            ],
            [
                'category_id' => 6,
                'lang' => 'en',
                'name' => 'Cleaning, disinfection',
            ],
            [
                'category_id' => 7,
                'lang' => 'am',
                'name' => 'Հաշվապահական հաշվառում և հարկեր',
            ],
            [
                'category_id' => 7,
                'lang' => 'ru',
                'name' => 'Бухгалтерский учет и налоги',
            ],
            [
                'category_id' => 7,
                'lang' => 'en',
                'name' => 'Accounting and taxes',
            ],
            [
                'category_id' => 8,
                'lang' => 'am',
                'name' => 'Դիզայնի ծառայություններ',
            ],
            [
                'category_id' => 8,
                'lang' => 'ru',
                'name' => 'Дизайнерские услуги',
            ],
            [
                'category_id' => 8,
                'lang' => 'en',
                'name' => 'Design services',
            ],
            [
                'category_id' => 9,
                'lang' => 'am',
                'name' => 'Իրադարձություններ',
            ],
            [
                'category_id' => 9,
                'lang' => 'ru',
                'name' => 'События',
            ],
            [
                'category_id' => 9,
                'lang' => 'en',
                'name' => 'Events',
            ],
            [
                'category_id' => 10,
                'lang' => 'am',
                'name' => 'Կրթություն',
            ],
            [
                'category_id' => 10,
                'lang' => 'ru',
                'name' => 'Образование',
            ],
            [
                'category_id' => 10,
                'lang' => 'en',
                'name' => 'Education and Teaching',
            ],
            [
                'category_id' => 11,
                'lang' => 'am',
                'name' => 'Կենցաղային ծառայություններ',
            ],
            [
                'category_id' => 11,
                'lang' => 'ru',
                'name' => 'Бытовые услуги',
            ],
            [
                'category_id' => 11,
                'lang' => 'en',
                'name' => 'Domestic Services',
            ],
            [
                'category_id' => 12,
                'lang' => 'am',
                'name' => 'Բիզնես ծառայություններ',
            ],
            [
                'category_id' => 12,
                'lang' => 'ru',
                'name' => 'Бизнес услуги',
            ],
            [
                'category_id' => 12,
                'lang' => 'en',
                'name' => 'Business Services',
            ],

            [
                'category_id' => 13,
                'lang' => 'am',
                'name' => 'Էլեկտրոնիկա',
            ],
            [
                'category_id' => 13,
                'lang' => 'ru',
                'name' => 'Электроника',
            ],
            [
                'category_id' => 13,
                'lang' => 'en',
                'name' => 'Electronics',
            ],
            [
                'category_id' => 14,
                'lang' => 'am',
                'name' => 'Գեղեցկություն և առողջություն',
            ],
            [
                'category_id' => 14,
                'lang' => 'ru',
                'name' => 'Красота и здоровье',
            ],
            [
                'category_id' => 14,
                'lang' => 'en',
                'name' => 'Beauty and Health',
            ],
            [
                'category_id' => 15,
                'lang' => 'am',
                'name' => 'Այլ ծառայություններ',
            ],
            [
                'category_id' => 15,
                'lang' => 'ru',
                'name' => 'Другие услуги',
            ],
            [
                'category_id' => 15,
                'lang' => 'en',
                'name' => 'Other Services',
            ],
            [
                'category_id' => 16,
                'lang' => 'am',
                'name' => 'Զբոսաշրջություն և ճանապարհորդություն',
            ],
            [
                'category_id' => 16,
                'lang' => 'ru',
                'name' => 'Туризм и путешествия',
            ],
            [
                'category_id' => 16,
                'lang' => 'en',
                'name' => 'Travel and Tourism',
            ],
            [
                'category_id' => 17,
                'lang' => 'am',
                'name' => 'Մեդիա և դիզայն',
            ],
            [
                'category_id' => 17,
                'lang' => 'ru',
                'name' => 'Медиа и дизайн',
            ],
            [
                'category_id' => 17,
                'lang' => 'en',
                'name' => 'Media and Design',
            ],








        ];

        foreach ($data as $item) {
            CategoryTranslation::updateOrCreate(['category_id' => $item['category_id'], 'name' => $item['name']], $item);
        }

    }
}
