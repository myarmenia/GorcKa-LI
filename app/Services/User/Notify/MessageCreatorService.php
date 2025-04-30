<?php
namespace App\Services\User\Notify;


use App\DTO\Chat\MessageDTO;
use App\Interfaces\Chat\MessageInterface;

class MessageCreatorService{

    public function __construct(
        protected MessageInterface $messageRepository
    ) {
    }

    public function create($room, $user, $notification_description){

        $messageData = new MessageDTO(
            room_id: $room->id,
            user_id: $user->id,
            message: $notification_description,
            from_app: 1
        );

        $this->messageRepository->store($messageData->toArray());

    }
}
