<?php

namespace App\Repositories\Notification;

use App\Interfaces\Notification\NotificationInterface;
use App\Models\Notification;
use App\Repositories\BaseRepository;

class NotificationRepository extends BaseRepository implements NotificationInterface
{
    public function __construct(Notification $model)
    {
        parent::__construct($model);
    }


}
