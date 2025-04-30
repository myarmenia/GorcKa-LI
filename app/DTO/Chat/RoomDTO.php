<?php

namespace App\DTO\Chat;


class RoomDTO
{
    public function __construct(
        public int $employer_id,
        public int $executor_id,
        public int $task_id

    ) {
    }

    public static function fromRoomDTO($data): self
    {

        return new self(
            $data->employer_id,
            $data->executor_id,
            $data->user_id

        );
    }

    public function toArray(): array
    {
        return [
            'employer_id' => $this->employer_id,
            'executor_id' => $this->executor_id,
            'task_id' => $this->task_id
        ];
    }
}
