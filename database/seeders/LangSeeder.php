<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lang;

class LangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $langs = [
            ['id' => 1, 'name' => 'am'],
            ['id' => 2, 'name' => 'ru'],
            ['id' => 3, 'name' => 'en'],
        ];

        foreach ($langs as $lang) {
            Lang::create($lang);
        }
    }
}
