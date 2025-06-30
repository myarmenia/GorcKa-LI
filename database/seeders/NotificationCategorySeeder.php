<?php

namespace Database\Seeders;

use App\Models\NotificationCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'id' => 1,
                'type' => 'info'
            ],
            [
                'id' => 2,
                'type' => 'new_job'
            ],
            [
                'id' => 3,
                'type' => 'job_applied'
            ],
            [
                'id' => 4,
                'type' => 'application_rejected'
            ],
            [
                'id' => 5,
                'type' => 'new_message'   // chat
            ],
            [
                'id' => 6,
                'type' => 'selected_executor'
            ],
            [
                'id' => 7,
                'type' => 'you_applied'
            ],
            [
                'id' => 8,
                'type' => 'job_expired'
            ],
            [
                'id' => 9,
                'type' => 'job_done'
            ],


        ];

        NotificationCategory::upsert($categories, ['id']);


    }
}
