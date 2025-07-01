<?php

namespace App\Interfaces\Comment;

use App\Interfaces\BaseInterface;

interface CommentInterface extends BaseInterface
{
    public function existComment(int $taskId);

}
