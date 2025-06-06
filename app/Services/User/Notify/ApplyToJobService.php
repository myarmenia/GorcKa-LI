<?php
namespace App\Services\User\Notify;

use App\Services\User\UserPointUpdaterService;


class ApplyToJobService extends SenderService
{
    // public function __construct(
    //     protected ApplicantCreatorService $applicantCreatorService,
    //     protected NotificationService $notificationService,
    //     protected UserPointUpdaterService $pointService,
    //     protected RoomCreatorService $roomCreatorService,
    //     protected MessageCreatorService $messageCreatorService,
    // ) {}

    public function __construct(
        protected ApplicantCreatorService $applicantCreatorService,
        protected UserPointUpdaterService $pointService,
        protected RoomCreatorService $roomCreatorService,
        NotificationService $notificationService,
        MessageCreatorService $messageCreatorService,
    ) {
        // Вызов конструктора родителя
        parent::__construct($notificationService, $messageCreatorService);
    }

    public function handle($task, $user, $employer): void
    {
        $taskName = $task->title;

        $this->applicantCreatorService->create($task, $user);

        $employer_notification = $this->notificationService->notify($employer, 'job_applied', $taskName);
        $executor_notification = $this->notificationService->notify($user, 'you_applied', $taskName);

        $room = $this->roomCreatorService->create($task, $user, $employer);

        $this->messageCreatorService->create($room, $user, $executor_notification->description);
        $this->messageCreatorService->create($room, $employer, $employer_notification->description);

        $this->pointService->decrement($user);
    }


}
