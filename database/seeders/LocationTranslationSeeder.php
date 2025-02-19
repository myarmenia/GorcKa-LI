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
                "lang"=>"am",
                "status"=>1

            ],
            [
                'location_id'=>1,
                'name' => 'Ереван',
                "lang"=>"ru",
                "status"=>1

            ],
            [
                'location_id'=>1,
                'name' => 'Yerevan',
                "lang"=>"en",
                "status"=>1

            ],
            [
                'location_id'=>2,
                'name' => 'Արագածոտն',
                "lang"=>"am",
                "status"=>1

            ],
            [
                'location_id'=>2,
                'name' => 'Арагацотн',
                "lang"=>"ru",
                "status"=>1

            ],
            [
                'location_id'=>2,
                'name' => 'Aragatsotn',
                "lang"=>"en",
                "status"=>1

            ],
            [
               'location_id'=>3,
                'name' => 'Արարատ',
                "lang"=>"am",
                "status"=>1
            ],
            [
                'location_id'=>3,
                 'name' => 'Арарат',
                 "lang"=>"ru",
                 "status"=>1
             ],
             [
                'location_id'=>3,
                 'name' => 'Ararat',
                 "lang"=>"en",
                 "status"=>1
             ],
            [
                'location_id'=>4,
                'name' => 'Արմավիր',
                "lang"=>"am",
                "status"=>1
            ],
            [
                'location_id'=>4,
                'name' => 'Армавир',
                "lang"=>"ru",
                "status"=>1
            ],
            [
                'location_id'=>4,
                'name' => 'Armavir',
                "lang"=>"en",
                "status"=>1
            ],
            [
                'location_id'=>5,
                'name' => 'Գեղարքունիք',
                "lang"=>"am",
                "status"=>1
            ],
            [
                'location_id'=>5,
                'name' => 'Гегаркуник',
                "lang"=>"ru",
                "status"=>1
            ],
            [
                'location_id'=>5,
                'name' => 'Gegharkunik',
                "lang"=>"en",
                "status"=>1
            ],
            [   'location_id'=>6,
                'name' => 'Կոտայք',
                "lang"=>"am",
                "status"=>1

            ],
            [   'location_id'=>6,
                'name' => 'Котайк',
                "lang"=>"ru",
                "status"=>1

            ],
            [   'location_id'=>6,
                'name' => 'Kotayk',
                "lang"=>"en",
                "status"=>1
            ],
            [
                'location_id'=>7,
                'name' => 'Լոռի',
                "lang"=>"am",
                "status"=>1
            ],
            [
                'location_id'=>7,
                'name' => 'Лори',
                "lang"=>"ru",
                "status"=>1
            ],
            [
                'location_id'=>7,
                'name' => 'Lori',
                "lang"=>"en",
                "status"=>1
            ],
            [
                'location_id'=>8,
                'name' => 'Շիրակ',
                "lang"=>"am",
                "status"=>1
            ],
            [
                'location_id'=>8,
                'name' => 'Ширак',
                "lang"=>"ru",
                "status"=>1
            ],
            [
                'location_id'=>8,
                'name' => 'Shirak',
                "lang"=>"en",
                "status"=>1
            ],
            [
                'location_id'=>9,
                'name' => 'Սյունիք',
                "lang"=>"am",
                "status"=>1
            ],
            [
                'location_id'=>9,
                'name' => 'Сюник',
                "lang"=>"ru",
                "status"=>1
            ],
            [
                'location_id'=>9,
                'name' => 'Syunik',
                "lang"=>"en",
                "status"=>1
            ],
            [
                'location_id'=>10,
                'name' => 'Տավուշ',
                "lang"=>"am",
                "status"=>1
            ],
            [
                'location_id'=>10,
                'name' => 'Тавуш',
                "lang"=>"ru",
                "status"=>1
            ],
            [
                'location_id'=>10,
                'name' => 'Tavush',
                "lang"=>"en",
                "status"=>1
            ],
            [
                'location_id'=>11,
                'name' => 'Վայոց ձոր',
                "lang"=>"am",
                "status"=>1
            ],
            [
                'location_id'=>11,
                'name' => 'Вайоц Дзор',
                "lang"=>"ru",
                "status"=>1
            ],
            [
                'location_id'=>11,
                'name' => 'Vayots Dzor',
                "lang"=>"en",
                "status"=>1
            ],
        ];

        LocationTranslation::insert($data);
    }
}
