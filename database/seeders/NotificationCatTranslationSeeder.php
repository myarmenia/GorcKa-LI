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
                'name' => 'Ինֆո',
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
                'name' => 'Դիմել',
            ],
            [
                'notification_category_id' => 3,
                'lang' => 'ru',
                'name' => 'Подать заявку',
            ],
            [
                'notification_category_id' => 3,
                'lang' => 'en',
                'name' => 'Apply',
            ],
            [
                'notification_category_id' => 4,
                'lang' => 'am',
                'name' => 'Մերժել',
            ],
            [
                'notification_category_id' => 4,
                'lang' => 'ru',
                'name' => 'Отклонять',
            ],
            [
                'notification_category_id' => 4,
                'lang' => 'en',
                'name' => 'Reject',
            ],
            [
                'notification_category_id' => 5,

                'lang' => 'am',
                'name' => 'Չատ',
            ],
            [
                'notification_category_id' => 5,
                'lang' => 'ru',
                'name' => 'Чат',
            ],
            [
                'notification_category_id' => 5,
                'lang' => 'en',
                'name' => 'Chat',
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
