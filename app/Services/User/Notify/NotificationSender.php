<?php
namespace App\Services\User\Notify;


use App\Events\NotificationEvent;
use App\Mail\JobApplicationSubmissionNotification;
use App\Models\Task;
use App\Services\FCM\FCMService;
use Mail;


class NotificationSender{

    public function dispatch($user, $notification, Task $task): void
    {
        $this->sendPush($user, $notification, $task->title);
        $this->sendEmail($user, $notification, $task);
        $this->sendUnreadCountSocket($user);
    }

    public function sendPush($user, $notification, $taskName): void
    {
        $title = $notification->title . ' - ' . $taskName;
        $sendeed = FCMService::sendNotification($user, $title, $notification->description);

    }

    public function sendEmail($user, $notification, $task): void
    {

        Mail::to($user->email)->send(new JobApplicationSubmissionNotification(
            $notification->title,
            $notification->description,
            $task,
            $user->lang

        ));
    }

    public function sendUnreadCountSocket($user): void
    {
        event(new NotificationEvent(
            $user->notifications()->unread()->count(),
            $user->id
        ));
    }

}
