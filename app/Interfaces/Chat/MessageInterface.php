<?php

namespace App\Interfaces\Chat;

use App\Interfaces\BaseInterface;

interface MessageInterface extends BaseInterface
{
    public function getRoomMessages(int $roomId);
    public function getUnreadMessages(int $roomId, int $userId);
    public function getUnreadMessagesCount(int $roomId, int $userId);
    public function getAllUnreadMessagesCount(int $userId);
    public function readMessages(int $roomId, int $userId);


}
