<?php
namespace App\Services\User\Notify;

use App\Interfaces\Chat\RoomInterface;
use App\Interfaces\Job\JobInterface;
use App\Interfaces\User\UserInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class NotifyService
{
    public function __construct(
        protected UserInterface $userRepository,
        protected ApplyToJobService $applyToJobService,
        protected JobInterface $jobRepository,
        protected SelectExecutorService $selectExecutorService,
        protected RoomInterface $roomRepository

    ) {
    }

    protected function runInTransaction(callable $callback): array
    {
        DB::beginTransaction();
        try {
            $response = $callback();

            DB::commit();
            return $response;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Ошибка в NotifyService: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Произошла ошибка, попробуйте позже'
            ];
        }
    }

    public function applyNow(object $data): array
    {
        return $this->runInTransaction(function () use ($data) {
            $user = Auth::user();
            $employer = $this->userRepository->getById($data->user_id);

            if (!$user->hasEnoughPointsForClick()) {
                return [
                    'success' => false,
                    'message' => __('validation_messages.enough_points')
                ];
            }

            $this->applyToJobService->handle($data, $user, $employer);

            return [
                'success' => true,
                'message' => __('validation_messages.success_apply_now')
            ];
        });
    }

    public function selectExecutor(int $roomId): array
    {
        return $this->runInTransaction(function () use ($roomId) {
            $employerId = Auth::id();
            $employer = $this->userRepository->getById($employerId);

            $room = $this->roomRepository->getById($roomId);
            $executor = $this->userRepository->getById($room->executor_id);
            $task = $this->jobRepository->getById($room->task_id);

            $this->selectExecutorService->handle($task, $room, $employer, $executor);

            return [
                'success' => true,
                'message' => 'Исполнитель успешно выбран'
            ];
        });
    }





}
