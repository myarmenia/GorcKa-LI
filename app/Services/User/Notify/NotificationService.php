<?php
namespace App\Services\User\Notify;

class NotificationService
{
    public function __construct(
        protected NotificationCreator $notificationCreator,
        protected NotificationSender $notificationSender

    ) {}

    public function notify($user, string $type, object $task, bool $is_comment = null){

        $notification = $this->notificationCreator->create($user, $type, $task->id, $is_comment );

        $this->notificationSender->dispatch($user, $notification, $task);

        return $notification;

    }

}
