<?php
namespace App\Services\User\Notify;


use App\Events\NotificationEvent;
use App\Mail\JobApplicationSubmissionNotification;
use App\Services\FCM\FCMService;
use Mail;


class NotificationSender{

    public function dispatch($user, $notification): void
    {
        $this->sendPush($user, $notification);
        $this->sendEmail($user, $notification);
        $this->sendUnreadCountSocket($user);
    }

    public function sendPush($user, $notification): void
    {
        FCMService::sendNotification($user, $notification->title, $notification->description);
    }

    public function sendEmail($user, $notification): void
    {
        Mail::to($user->email)->send(new JobApplicationSubmissionNotification(
            $notification->title,
            $notification->description
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
