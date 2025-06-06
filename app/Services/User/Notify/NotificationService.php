<?php
namespace App\Services\User\Notify;

class NotificationService
{
    public function __construct(
        protected NotificationCreator $notificationCreator,
        protected NotificationSender $notificationSender

    ) {}

    public function notify($user, string $type, string $taskName){

        $notification = $this->notificationCreator->create($user, $type );
 
        $this->notificationSender->dispatch($user, $notification, $taskName);

        return $notification;

    }

}
