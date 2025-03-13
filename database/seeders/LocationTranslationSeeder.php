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
                "lang"=>"am"
            ],
            [
                'location_id'=>1,
                'name' => 'Ереван',
                "lang"=>"ru"
            ],
            [
                'location_id'=>1,
                'name' => 'Yerevan',
                "lang"=>"en"
            ],
            [
                'location_id'=>2,
                'name' => 'Արագածոտն',
                "lang"=>"am"

            ],
            [
                'location_id'=>2,
                'name' => 'Арагацотн',
                "lang"=>"ru"

            ],
            [
                'location_id'=>2,
                'name' => 'Aragatsotn',
                "lang"=>"en"

            ],
            [
               'location_id'=>3,
                'name' => 'Արարատ',
                "lang"=>"am"
            ],
            [
                'location_id'=>3,
                 'name' => 'Арарат',
                 "lang"=>"ru"
             ],
             [
                'location_id'=>3,
                 'name' => 'Ararat',
                 "lang"=>"en"
             ],
            [
                'location_id'=>4,
                'name' => 'Արմավիր',
                "lang"=>"am"
            ],
            [
                'location_id'=>4,
                'name' => 'Армавир',
                "lang"=>"ru"
            ],
            [
                'location_id'=>4,
                'name' => 'Armavir',
                "lang"=>"en"
            ],
            [
                'location_id'=>5,
                'name' => 'Գեղարքունիք',
                "lang"=>"am"
            ],
            [
                'location_id'=>5,
                'name' => 'Гегаркуник',
                "lang"=>"ru"
            ],
            [
                'location_id'=>5,
                'name' => 'Gegharkunik',
                "lang"=>"en"
            ],
            [   'location_id'=>6,
                'name' => 'Կոտայք',
                "lang"=>"am"

            ],
            [   'location_id'=>6,
                'name' => 'Котайк',
                "lang"=>"ru"

            ],
            [   'location_id'=>6,
                'name' => 'Kotayk',
                "lang"=>"en"
            ],
            [
                'location_id'=>7,
                'name' => 'Լոռի',
                "lang"=>"am"
            ],
            [
                'location_id'=>7,
                'name' => 'Лори',
                "lang"=>"ru"
            ],
            [
                'location_id'=>7,
                'name' => 'Lori',
                "lang"=>"en"
            ],
            [
                'location_id'=>8,
                'name' => 'Շիրակ',
                "lang"=>"am"
            ],
            [
                'location_id'=>8,
                'name' => 'Ширак',
                "lang"=>"ru"
            ],
            [
                'location_id'=>8,
                'name' => 'Shirak',
                "lang"=>"en"
            ],
            [
                'location_id'=>9,
                'name' => 'Սյունիք',
                "lang"=>"am"
            ],
            [
                'location_id'=>9,
                'name' => 'Сюник',
                "lang"=>"ru"
            ],
            [
                'location_id'=>9,
                'name' => 'Syunik',
                "lang"=>"en"
            ],
            [
                'location_id'=>10,
                'name' => 'Տավուշ',
                "lang"=>"am"
            ],
            [
                'location_id'=>10,
                'name' => 'Тавуш',
                "lang"=>"ru"
            ],
            [
                'location_id'=>10,
                'name' => 'Tavush',
                "lang"=>"en"
            ],
            [
                'location_id'=>11,
                'name' => 'Վայոց ձոր',
                "lang"=>"am"
            ],
            [
                'location_id'=>11,
                'name' => 'Вайоц Дзор',
                "lang"=>"ru"
            ],
            [
                'location_id'=>11,
                'name' => 'Vayots Dzor',
                "lang"=>"en"
            ],
        ];


        foreach ($data as $loc) {
            LocationTranslation::updateOrCreate(['location_id' => $loc['location_id'], 'name' => $loc['name']], $loc);
        }
    }
}
