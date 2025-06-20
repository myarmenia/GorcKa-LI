<?php
namespace App\Services\User\Notify;

use App\Interfaces\Job\JobInterface;
use App\Models\Task;
use App\Services\User\UserPointUpdaterService;
use Log;


class SelectExecutorService extends SenderService
{
    public function __construct(
        protected JobInterface $jobRepository,
        NotificationService $notificationService,
        MessageCreatorService $messageCreatorService,
    ) {
        
        parent::__construct($notificationService, $messageCreatorService);
    }

    public function handle($task, $room, $employer, $executor): mixed
    {

        $unselected_users = $this->jobRepository->getUnselectedApplicants($task, $executor->id);
        $update = $task->update(['executor_id' => $executor->id, 'status' => 'in_process']);

        if($update){
            try {
                foreach ($unselected_users as $key => $value) {
                    $notif = $this->notificationService->notify($value, 'application_rejected', $task);
                    $this->messageCreatorService->create($room, $value, $notif->description);
                }
            } catch (\Throwable $e) {
                Log::error('Ошибка при обработке unselected_users: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
                throw $e;
            }

            // $employer_notification = $this->notificationService->notify($employer, 'selected_executor', $task);
            $executor_notification = $this->notificationService->notify($executor, 'selected_executor', $task);

            // $this->messageCreatorService->create($room, $employer, $employer_notification->description);
            // $this->messageCreatorService->create($room, $executor, $executor_notification->description);

        }

        return $update;

    }


}
