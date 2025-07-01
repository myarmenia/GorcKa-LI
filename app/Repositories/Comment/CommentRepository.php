<?php

namespace App\Repositories\Comment;

use App\Interfaces\Comment\CommentInterface;
use App\Models\Notification;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class CommentRepository extends BaseRepository implements CommentInterface
{
    public function __construct(Notification $model)
    {
        parent::__construct($model);
    }

    public function existComment(int $taskId){
        return $this->model->where('task_id', $taskId)
            ->where('author_id', Auth::id())
            ->exists();
    }


}
