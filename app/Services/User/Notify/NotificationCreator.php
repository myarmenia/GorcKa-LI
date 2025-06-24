<?php
namespace App\Services\User\Notify;


use App\DTO\Notification\NotificationDTO;
use App\Helpers\Helper;
use App\Interfaces\Notification\NotificationInterface;
class NotificationCreator{
    public function __construct(
        protected NotificationInterface $notificationRepository
    ) {
    }

    public function create($user, string $type, int $task_id = null)
    {
        $notification_category_id = Helper::getNotificationCategoryId($type);
        $translation = Helper::getNotificationTranslation($notification_category_id, app()->getLocale());

        $notification = new NotificationDTO(
            user_id: $user->id,
            notification_category_id: $notification_category_id,
            task_id: $task_id,
            title: $translation?->name ?? '-',
            description: $translation?->description ?? '-'
        );

        $this->notificationRepository->store($notification->toArray());

        return $notification;

    }

}
