<?php

namespace Database\Seeders;

use App\Models\NotificCatTrans;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationCatTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'notification_category_id' => 1,
                'lang' => 'am',
                'name' => 'Տեղեկատվական',
            ],
            [
                'notification_category_id' => 1,
                'lang' => 'ru',
                'name' => 'Информация',
            ],
            [
                'notification_category_id' => 1,
                'lang' => 'en',
                'name' => 'Info',
            ],
            [
                'notification_category_id' => 2,
                'lang' => 'am',
                'name' => 'Նոր աշխատանք',
            ],
            [
                'notification_category_id' => 2,
                'lang' => 'ru',
                'name' => 'Новая работа',
            ],
            [
                'notification_category_id' => 2,
                'lang' => 'en',
                'name' => 'New job',
            ],
            [
                'notification_category_id' => 3,
                'lang' => 'am',
                'name' => 'Աշխատանքին դիմել են',
            ],
            [
                'notification_category_id' => 3,
                'lang' => 'ru',
                'name' => 'Подали заявку на работу',
            ],
            [
                'notification_category_id' => 3,
                'lang' => 'en',
                'name' => 'Job applied',
            ],
            [
                'notification_category_id' => 4,
                'lang' => 'am',
                'name' => 'Դիմումը մերժվել է',
            ],
            [
                'notification_category_id' => 4,
                'lang' => 'ru',
                'name' => 'Заявка отклонена',
            ],
            [
                'notification_category_id' => 4,
                'lang' => 'en',
                'name' => 'Application rejected',
            ],
            [
                'notification_category_id' => 5,

                'lang' => 'am',
                'name' => 'Նոր հաղորդագրություն',
            ],
            [
                'notification_category_id' => 5,
                'lang' => 'ru',
                'name' => 'Новое сообщение',
            ],
            [
                'notification_category_id' => 5,
                'lang' => 'en',
                'name' => 'New message',
            ],
            [
                'notification_category_id' => 6,
                'lang' => 'am',
                'name' => 'Ընտրված կատարող',
            ],
            [
                'notification_category_id' => 6,
                'lang' => 'ru',
                'name' => 'Выбранный исполнитель',
            ],
            [
                'notification_category_id' => 6,
                'lang' => 'en',
                'name' => 'Selected executor',
            ]


        ];

        foreach ($data as $item) {
            NotificCatTrans::updateOrCreate(['notification_category_id' => $item['notification_category_id'], 'name' => $item['name']], $item);
        }
    }
}
