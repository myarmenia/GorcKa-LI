<?php

namespace App\Repositories\Comment;

use App\Interfaces\Comment\CommentInterface;
use App\Models\Notification;
use App\Repositories\BaseRepository;

class CommentRepository extends BaseRepository implements CommentInterface
{
    public function __construct(Notification $model)
    {
        parent::__construct($model);
    }


}
