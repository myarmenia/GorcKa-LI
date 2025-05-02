<?php
namespace App\Services\User\Notify;

use App\Services\User\UserPointUpdaterService;


class ApplyToJobService
{
    public function __construct(
        protected ApplicantCreatorService $applicantCreatorService,
        protected NotificationService $notificationService,
        protected UserPointUpdaterService $pointService,
        protected RoomCreatorService $roomCreatorService,
        protected MessageCreatorService $messageCreatorService,
    ) {}

    public function handle($task, $user, $employer): void
    {
        $this->applicantCreatorService->create($task, $user);

        $employer_notification = $this->notificationService->notify($employer, 'job_applied');
        $executor_notification = $this->notificationService->notify($user, 'you_applied');

        $room = $this->roomCreatorService->create($task, $user, $employer);

        $this->messageCreatorService->create($room, $user, $executor_notification->description);
        $this->messageCreatorService->create($room, $employer, $employer_notification->description);

        $this->pointService->decrement($user);
    }


}
