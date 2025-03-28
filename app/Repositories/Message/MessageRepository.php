<?php

namespace App\Repositories\Message;

use App\Interfaces\Message\MessageInterface;
use App\Models\Message;
use App\Repositories\BaseRepository;

class MessageRepository extends BaseRepository implements MessageInterface
{
    public function __construct(Message $model)
    {
        parent::__construct($model);
    }


}
