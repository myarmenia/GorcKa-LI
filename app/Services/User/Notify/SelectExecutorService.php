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
        // Вызов конструктора родителя
        parent::__construct($notificationService, $messageCreatorService);
    }

    public function handle($task, $room, $employer, $executor): mixed
    {

        $taskName = $task->title;

        $unselected_users = $this->jobRepository->getUnselectedApplicants($task, $executor->id);
        $update = $task->update(['executor_id' => $executor->id, 'status' => 'in_process']);
        // $task = Task::find(1);
        // $task->executor_id = $executor->id;
        // $task->status = 'in_process';
        // $task->save();

        if($update){
            try {
                foreach ($unselected_users as $key => $value) {
                    $notif = $this->notificationService->notify($value, 'application_rejected', $task);
                    $this->messageCreatorService->create($room, $value, $notif->description);
                }
            } catch (\Throwable $e) {
                Log::error('Ошибка при обработке unselected_users: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
                throw $e; // пробрасывай дальше, чтобы сработал rollBack
            }


            $employer_notification = $this->notificationService->notify($employer, 'selected_executor', $taskName);
            // $executor_notification = $this->notificationService->notify($executor, 'selected_executor', $taskName);
dd($employer_notification);
            $this->messageCreatorService->create($room, $employer, $employer_notification->description);
            $this->messageCreatorService->create($room, $executor, $executor_notification->description);


        }
        dd($update);
        return $update;

    }


}
