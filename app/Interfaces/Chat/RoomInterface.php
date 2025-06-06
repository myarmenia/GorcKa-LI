<?php

namespace App\Interfaces\Chat;

use App\Interfaces\BaseInterface;

interface RoomInterface extends BaseInterface
{

    public function getInterlocutorId($roomId);

    public function getRooms($request);

}
