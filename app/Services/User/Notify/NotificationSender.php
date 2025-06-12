<?php
namespace App\Services\User\Notify;


use App\Events\NotificationEvent;
use App\Mail\JobApplicationSubmissionNotification;
use App\Services\FCM\FCMService;
use Mail;


class NotificationSender{

    public function dispatch($user, $notification, string $taskName): void
    {
        $this->sendPush($user, $notification, $taskName);
        $this->sendEmail($user, $notification, $taskName);
        $this->sendUnreadCountSocket($user);
    }

    public function sendPush($user, $notification, $taskName): void
    {
        $title = $notification->title . ' - ' . $taskName;
        FCMService::sendNotification($user, $title, $notification->description);
    }

    public function sendEmail($user, $notification, $taskName): void
    {

        Mail::to($user->email)->send(new JobApplicationSubmissionNotification(
            $notification->title,
            $notification->description,
            $taskName
        ));
    }

    public function sendUnreadCountSocket($user): void
    {
        event(new NotificationEvent(
            $user->notifications()->unread()->count(),
            'job_applied',
            $user->id
        ));
    }

}
