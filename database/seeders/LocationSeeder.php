<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            ['id' => 1,],
            ['id' => 2,],
            ['id' => 3,],
            ['id' => 4,],
            ['id' => 5,],
            ['id' => 6,],
            ['id' => 7,],
            ['id' => 8,],
            ['id' => 9,],
            ['id' => 10,],
            ['id' => 11,],


        ];

        Location::upsert($locations, ['id']);
    }
}
