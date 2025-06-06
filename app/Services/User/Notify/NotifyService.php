<?php
namespace App\Services\User\Notify;

use App\Events\Chat\ChangeJobApplicantsStatus;
use App\Interfaces\Chat\RoomInterface;
use App\Interfaces\Job\JobInterface;
use App\Interfaces\User\UserInterface;
use Illuminate\Http\JsonResponse;
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

    protected function runInTransaction(callable $callback): JsonResponse
    {
        DB::beginTransaction();
        try {
            $response = $callback();
            DB::commit();
            return $response;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Ошибка в NotifyService: ' . $e->getMessage());
            return response()->json(['error' => 'Произошла ошибка, попробуйте позже'], 500);
        }
    }

    public function applyNow(object $data): JsonResponse
    {
        return $this->runInTransaction(function () use ($data) {
            $user = Auth::user();
            $employer = $this->userRepository->getById($data->user_id);

            $this->applyToJobService->handle($data, $user, $employer);

            return response()->json(['message' => 'Заявка успешно отправлена']);
        });
    }

    public function selectExecutor(int $roomId): JsonResponse
    {
        return $this->runInTransaction(function () use ($roomId) {
            $employerId = Auth::id();
            $employer = $this->userRepository->getById($employerId);

            $room = $this->roomRepository->getById($roomId);
            $executor = $this->userRepository->getById($room->executor_id);
            $task = $this->jobRepository->getById($room->task_id);

            $this->selectExecutorService->handle($task, $room, $employer, $executor);

            return response()->json(['message' => 'Исполнитель успешно выбран']);
        });
    }





}
