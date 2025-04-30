<?php
namespace App\Services\Chat;

use App\Events\MessageSent;
use App\Interfaces\Chat\ChatInterface;
use App\Interfaces\Chat\MessageInterface;
use App\Interfaces\Chat\RoomInterface;
use App\Models\Task;


class MessagesService
{

    public function __construct(
            protected MessageInterface $messageRepository,
            protected RoomInterface $roomRepository

        )
    {
    }

    public function getRoomMessages($roomId)
    {
        return $this->messageRepository->getRoomMessages($roomId);

    }

    public function storeMessage($data)
    {

        $data->user_id = $this->roomRepository->getInterlocutorId($data->room_id);

        $message = $this->messageRepository->store($data->toArray());

        event(new MessageSent($message));

        return $message;

    }

    public function readMessages(int $roomId, int $userId){
        return $this->messageRepository->readMessages($roomId, $userId);

    }




}
