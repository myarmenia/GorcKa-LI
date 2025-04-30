<?php
namespace App\Services\User\Notify;

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
        protected ApplyToJobService $applyToJobService
    ) {
    }

    public function applyNow(object $data): JsonResponse
    {

        DB::beginTransaction();

        try {
            $user = Auth::user();
            $employerId = $data->user_id;  // task creator id
            $employer = $this->userRepository->getById($employerId);

            $this->applyToJobService->handle($data, $user, $employer);

            DB::commit();
            return response()->json(['message' => 'Заявка успешно отправлена']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Ошибка при подаче заявки: ' . $e->getMessage());
            return response()->json(['error' => 'Произошла ошибка, попробуйте позже'], 500);
        }
    }


}
