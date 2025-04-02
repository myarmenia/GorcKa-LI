<?php
namespace App\Services\User;

use App\DTO\Message\MessageDTO;
use App\DTO\Notification\NotificationDTO;
use App\DTO\Room\RoomDTO;
use App\DTO\User\ApplicantDTO;
use App\DTO\User\UserDTO;
use App\Events\NotificationEvent;
use App\Events\NotifyEvent;
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
            $employerId = $data->user_id;  // task creator id

            // Creating applicant
            // $data->point = 1;
            // $data->user_id = $user->id;
            // dd($data->toArray());
            $applicantData = new ApplicantDTO(
                task_id: $data->id,
                point: 1,
                user_id: $user->id
            );

            $this->applicantRepository->store($applicantData->toArray());


            // Creating notification
            $notification_category_id = Helper::getNotificationCategoryId('job_applied');
            $notification_trans = Helper::getNotificationTranslation($notification_category_id, app()->getLocale());   // app()->getLocale() kareli e poxanakel useri yntrats lezuyov, vory yntrvum e profilic
            $notification_title = $notification_trans?->name ?? 'Աշխատանքին դիմել են';
            $notification_description = $notification_trans?->description ?? 'Ձեր հրապարակած աշխատանքին դիմել են:';


            $notifyData = new NotificationDTO(
                user_id: $employerId,
                notification_category_id: $notification_category_id,
                title: $notification_title,
                description: $notification_description
            );
            $this->notificationRepository->store($notifyData->toArray());


            // Creating room
            $roomData = new RoomDTO(
                employer_id: $employerId,
                executor_id: $user->id,
                task_id: $data->id
            );
            $room = $this->roomRepository->store($roomData->toArray());


            // Creating first message in room
            $messageData = new MessageDTO(
                room_id: $room->id,
                user_id: $employerId,
                message: $notification_description
            );

            $this->messageRepository->store($messageData->toArray());

            // Updating user -1 point for click to job
            $point = $user->point - 1;
            $this->userRepository->update($user->id, ['point' => $point]);

            // send push-notification
            $employer = $this->userRepository->getById($employerId);

            if ($employer) {
                Log::info("📢 Отправка FCM-уведомления работодателю {$employer->id}, токен: " . $employer->fcm_token);
                FCMService::sendNotification($employer, $notification_title, $notification_description);
            }


            // // send mail to employer
            Mail::to($employer->email)->send(new JobApplicationSubmissionNotification($notification_title, $notification_description));


            // send employer unread notification count via socket
            $unreadNotificationCount = $employer->notifications()->unread()->count();

            event(
                new NotificationEvent($unreadNotificationCount, 'job_applied', $employerId)
            );


            DB::commit();
            return response()->json(['message' => 'Заявка успешно отправлена']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Ошибка при подаче заявки: ' . $e->getMessage());
            return response()->json(['error' => 'Произошла ошибка, попробуйте позже'], 500);
        }
    }
}
