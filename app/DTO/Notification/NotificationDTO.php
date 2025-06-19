<?php

namespace App\DTO\Notification;

use Date;


class NotificationDTO
{
    public function __construct(
        public int $user_id,
        public ?int $notification_category_id,
        public ?int $task_id,
        public ?string $title,
        public ?string $description,
        // public ?Date $read_at,

    ) {
    }

    public static function fromNotificationDTO($data): self
    {

        return new self(
            $data->user_id ?? null,
            $data->notification_category_id ?? null,
            $data->task_id ?? null,
            $data->title ?? null,
            $data->description ?? null,
            // $data->read_at ?? null

        );
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'notification_category_id' => $this->notification_category_id,
            'task_id' => $this->task_id,
            'title' => $this->title,
            'description' => $this->description,
            // 'read_at' => $this->read_at

        ];
    }
}
