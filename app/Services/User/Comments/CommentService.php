<?php
namespace App\Services\User\Comments;

use App\Interfaces\Comment\CommentInterface;
use App\Interfaces\Notification\NotificationInterface;
use App\Interfaces\User\UserInterface;
use App\Models\Task;
use App\Services\User\Notify\NotificationService;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    public function __construct(
        protected UserInterface $userRepository,
        protected CommentInterface $commentRepository,
        protected NotificationInterface $notificationRepository,
        protected NotificationService $notificationService


        )
    {
    }


    public function storeComment($data)
    {

        $exists = $this->commentRepository->existComment($data->task_id);

        if ($exists) {
            return false;
        }

        $auth_user = Auth::user();
        $task = Task::find($data->task_id);

        $employer = $task->user;
        $executor = $task->executor;
        $data->author_id = $auth_user->id;

        if ($auth_user->id === $employer->id) {
            // Работодатель пишет исполнителю
            $data->recipient_id = $executor->id;
            $data->role_from = 'employer';
            $data->role_to = 'executor';
        }
        else {
            // Исполнитель пишет работодателю
            $data->recipient_id = $employer->id;
            $data->role_from = 'executor';
            $data->role_to = 'employer';
        }


        $storeComment = $this->commentRepository->store($data->toArray());

        if($storeComment){

            $this->notificationRepository->update($data->notification_id, ['has_comment' => 1]);

            if ($auth_user->id === $employer->id) {
                $this->notificationService->notify($executor, 'comment_mark', $task);
            }
            else{
                $this->notificationService->notify($employer, 'comment_mark', $task);
            }

        }

        return $storeComment;

    }




}
