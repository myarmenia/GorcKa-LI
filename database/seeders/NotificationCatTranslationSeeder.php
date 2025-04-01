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
                'description' => 'Տեղեկատվական:'
            ],
            [
                'notification_category_id' => 1,
                'lang' => 'ru',
                'name' => 'Информация',
                'description' => 'Информация'
            ],
            [
                'notification_category_id' => 1,
                'lang' => 'en',
                'name' => 'Info',
                'description' => 'Info'
            ],
            [
                'notification_category_id' => 2,
                'lang' => 'am',
                'name' => 'Նոր աշխատանք',
                'description' => 'Ձեր նախընտրած կատեգորիայով նոր աշխատանք է հրապարակվել:'
            ],
            [
                'notification_category_id' => 2,
                'lang' => 'ru',
                'name' => 'Новая работа',
                'description' => 'В выбранной вами категории опубликована новая вакансия.'

            ],
            [
                'notification_category_id' => 2,
                'lang' => 'en',
                'name' => 'New job',
                'description' => 'A new job has been posted in your preferred category.'

            ],
            [
                'notification_category_id' => 3,
                'lang' => 'am',
                'name' => 'Աշխատանքին դիմել են',
                'description' => 'Ձեր հրապարակած աշխատանքին դիմել են:'

            ],
            [
                'notification_category_id' => 3,
                'lang' => 'ru',
                'name' => 'Подали заявку на работу',
                'description' => 'Подано новая заявка на вашу опубликованную работу.'

            ],
            [
                'notification_category_id' => 3,
                'lang' => 'en',
                'name' => 'Job applied',
                'description' => 'A new application has been submitted for your published job.'

            ],
            [
                'notification_category_id' => 4,
                'lang' => 'am',
                'name' => 'Դիմումը մերժվել է',
                'description' => 'Աշխատանքի Ձեր դիմումը մերժվել է:'

            ],
            [
                'notification_category_id' => 4,
                'lang' => 'ru',
                'name' => 'Заявка отклонена',
                'description' => 'Ваша заявка на работу отклонена.'

            ],
            [
                'notification_category_id' => 4,
                'lang' => 'en',
                'name' => 'Application Rejected',
                'description' => 'Your job application has been rejected.'

            ],
            [
                'notification_category_id' => 5,

                'lang' => 'am',
                'name' => 'Նոր հաղորդագրություն',
                'description' => 'Դուք ունեք նոր հաղորդագրություն:'

            ],
            [
                'notification_category_id' => 5,
                'lang' => 'ru',
                'name' => 'Новое сообщение',
                'description' => 'У вас новое сообщение.'

            ],
            [
                'notification_category_id' => 5,
                'lang' => 'en',
                'name' => 'New message',
                'description' => 'You have a new message.'

            ],
            [
                'notification_category_id' => 6,
                'lang' => 'am',
                'name' => 'Ընտրված կատարող',
                'description' => 'Աշխատանքի Ձեր դիմումը հաստատվել է.'

            ],
            [
                'notification_category_id' => 6,
                'lang' => 'ru',
                'name' => 'Выбранный исполнитель',
                'description' => 'Ваша заявка на работу одобрена.'

            ],
            [
                'notification_category_id' => 6,
                'lang' => 'en',
                'name' => 'Selected executor',
                'description' => 'Your job application has been approved.'

            ]


        ];

        foreach ($data as $item) {
            NotificCatTrans::updateOrCreate(['notification_category_id' => $item['notification_category_id'], 'name' => $item['name']], $item);
        }
    }
}
