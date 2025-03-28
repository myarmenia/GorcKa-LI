<?php

namespace App\Repositories\Room;

use App\Interfaces\Room\RoomInterface;
use App\Models\Room;
use App\Repositories\BaseRepository;

class RoomRepositry extends BaseRepository implements RoomInterface
{
    public function __construct(Room $model)
    {
        parent::__construct($model);
    }


}
