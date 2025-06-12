<?php
namespace App\Services\User\Notify;

use App\Services\User\UserPointUpdaterService;


abstract class SenderService
{
    public function __construct(
        protected NotificationService $notificationService,
        protected MessageCreatorService $messageCreatorService,
    ) {
    }

   
}
