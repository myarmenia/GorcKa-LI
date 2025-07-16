<?php
namespace App\Services\User\Notify;

abstract class SenderService
{
    public function __construct(
        protected NotificationService $notificationService,
        protected MessageCreatorService $messageCreatorService,
    ) {
    }


}
