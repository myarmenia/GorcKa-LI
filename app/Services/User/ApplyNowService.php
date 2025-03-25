<?php
namespace App\Services\User;

use App\DTO\Message\MessageDTO;
use App\DTO\Notification\NotificationDTO;
use App\DTO\Room\RoomDTO;
use App\Helpers\Helper;
use App\Interfaces\Applicant\ApplicantInterface;
use App\Interfaces\Message\MessageInterface;
use App\Interfaces\Notification\NotificationInterface;
use App\Interfaces\Room\RoomInterface;
use App\Interfaces\User\UserInterface;
use App\Mail\JobApplicationSubmissionNotification;
use App\Models\Task;
use App\Services\FCM\FCMService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Mail;

class ApplyNowService
{
    public function __construct(
        protected ApplicantInterface $applicantRepository,
        protected NotificationInterface $notificationRepository,
        protected UserInterface $userRepository,
        protected RoomInterface $roomRepository,
        protected MessageInterface $messageRepository,
        protected Task $task
    ) {
    }

    public function applyNow($data)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();
            $employerId = $data->user_id;

            // Creating applicant
            $data->point = 1;
            $data->user_id = $user->id;
            $this->applicantRepository->store($data->toArray());

            // Creating notification
            $notifyData = new NotificationDTO(
                user_id: $employerId,
                notification_category_id: Helper::getNotificationCategoryId('apply'),
                title: 'Уведомление',
                description: "$employerId - новый отклик на задачу"
            );
            $this->notificationRepository->store($notifyData->toArray());

            // Creating room
            $roomData = new RoomDTO(
                employer_id: $employerId,
                executor_id: $user->id,
                task_id: $data->task_id
            );
            $room = $this->roomRepository->store($roomData->toArray());

            // Creating first message in room
            $messageData = new MessageDTO(
                room_id: $room->id,
                user_id: $employerId,
                message: 'apply'
            );

            $this->messageRepository->store($messageData->toArray());

            // send push-notification
            $employer = $this->userRepository->getById($employerId);

            if ($employer) {
                FCMService::sendNotification($employer, 'Новый отклик', 'Вы получили новый отклик на задачу');
            }

            // send mail to employer
            Mail::to($employer->email)->send(new JobApplicationSubmissionNotification('Новый отклик', 'Вы получили новый отклик на задачу'));


            //
            DB::commit();
            return response()->json(['message' => 'Заявка успешно отправлена']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Ошибка при подаче заявки: ' . $e->getMessage());
            return response()->json(['error' => 'Произошла ошибка, попробуйте позже'], 500);
        }
    }
}
