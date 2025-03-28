<?php

namespace App\DTO\Message;


class MessageDTO
{
    public function __construct(
        public int $room_id,
        public int $user_id,
        public string $message

    ) {
    }

    public static function fromMessageDTO($data): self
    {

        return new self(
            $data->room_id,
            $data->user_id,
            $data->user_id

        );
    }

    public function toArray(): array
    {
        return [
            'room_id' => $this->room_id,
            'user_id' => $this->user_id,
            'message' => $this->message
        ];
    }
}
