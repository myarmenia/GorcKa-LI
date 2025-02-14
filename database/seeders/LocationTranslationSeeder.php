<?php

namespace Database\Seeders;

use App\Models\LocationTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            [
                'location_id'=>1,
                'name' => 'Երևան',
                "lang_id"=>1,
                "status"=>1

            ],
            [
                'location_id'=>1,
                'name' => 'Ереван',
                "lang_id"=>2,
                "status"=>1

            ],
            [
                'location_id'=>1,
                'name' => 'Yerevan',
                "lang_id"=>3,
                "status"=>1

            ],
            [
                'location_id'=>2,
                'name' => 'Արագածոտն',
                "lang_id"=>1,
                "status"=>1

            ],
            [
                'location_id'=>2,
                'name' => 'Арагацотн',
                "lang_id"=>2,
                "status"=>1

            ],
            [
                'location_id'=>2,
                'name' => 'Aragatsotn',
                "lang_id"=>3,
                "status"=>1

            ],
            [
               'location_id'=>3,
                'name' => 'Արարատ',
                "lang_id"=>1,
                "status"=>1
            ],
            [
                'location_id'=>3,
                 'name' => 'Арарат',
                 "lang_id"=>2,
                 "status"=>1
             ],
             [
                'location_id'=>3,
                 'name' => 'Ararat',
                 "lang_id"=>3,
                 "status"=>1
             ],
            [
                'location_id'=>4,
                'name' => 'Արմավիր',
                "lang_id"=>1,
                "status"=>1
            ],
            [
                'location_id'=>4,
                'name' => 'Армавир',
                "lang_id"=>2,
                "status"=>1
            ],
            [
                'location_id'=>4,
                'name' => 'Armavir',
                "lang_id"=>3,
                "status"=>1
            ],
            [
                'location_id'=>5,
                'name' => 'Գեղարքունիք',
                "lang_id"=>1,
                "status"=>1
            ],
            [
                'location_id'=>5,
                'name' => 'Гегаркуник',
                "lang_id"=>2,
                "status"=>1
            ],
            [
                'location_id'=>5,
                'name' => 'Gegharkunik',
                "lang_id"=>3,
                "status"=>1
            ],
            [   'location_id'=>6,
                'name' => 'Կոտայք',
                "lang_id"=>1,
                "status"=>1

            ],
            [   'location_id'=>6,
                'name' => 'Котайк',
                "lang_id"=>2,
                "status"=>1

            ],
            [   'location_id'=>6,
                'name' => 'Kotayk',
                "lang_id"=>3,
                "status"=>1
            ],
            [
                'location_id'=>7,
                'name' => 'Լոռի',
                "lang_id"=>1,
                "status"=>1
            ],
            [
                'location_id'=>7,
                'name' => 'Лори',
                "lang_id"=>2,
                "status"=>1
            ],
            [
                'location_id'=>7,
                'name' => 'Lori',
                "lang_id"=>3,
                "status"=>1
            ],
            [
                'location_id'=>8,
                'name' => 'Շիրակ',
                "lang_id"=>1,
                "status"=>1
            ],
            [
                'location_id'=>8,
                'name' => 'Ширак',
                "lang_id"=>2,
                "status"=>1
            ],
            [
                'location_id'=>8,
                'name' => 'Shirak',
                "lang_id"=>3,
                "status"=>1
            ],
            [
                'location_id'=>9,
                'name' => 'Սյունիք',
                "lang_id"=>1,
                "status"=>1
            ],
            [
                'location_id'=>9,
                'name' => 'Сюник',
                "lang_id"=>2,
                "status"=>1
            ],
            [
                'location_id'=>9,
                'name' => 'Syunik',
                "lang_id"=>3,
                "status"=>1
            ],
            [
                'location_id'=>10,
                'name' => 'Տավուշ',
                "lang_id"=>1,
                "status"=>1
            ],
            [
                'location_id'=>10,
                'name' => 'Тавуш',
                "lang_id"=>2,
                "status"=>1
            ],
            [
                'location_id'=>10,
                'name' => 'Tavush',
                "lang_id"=>3,
                "status"=>1
            ],
            [
                'location_id'=>11,
                'name' => 'Վայոց ձոր',
                "lang_id"=>1,
                "status"=>1
            ],
            [
                'location_id'=>11,
                'name' => 'Вайоц Дзор',
                "lang_id"=>2,
                "status"=>1
            ],
            [
                'location_id'=>11,
                'name' => 'Vayots Dzor',
                "lang_id"=>3,
                "status"=>1
            ],
        ];

        LocationTranslation::insert($data);
    }
}
