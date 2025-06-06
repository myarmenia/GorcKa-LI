<?php

namespace App\DTO\Chat;


class MessageDTO
{
    public function __construct(
        public int $room_id,
        public ?int $user_id,
        public ?string $message = null,
        public ?string $from_app = null,
        public ?array $files = null,
        public ?string $read_at = null


    ) {
    }

    public static function fromMessageDTO($data): self
    {

        return new self(
            $data->room_id,
            $data->user_id ?? null,
            $data->message ?? null,
            $data->from_app ?? null,
            $data->files ?? null,
            $data->read_at ?? null


        );
    }

    public function toArray(): array
    {
        return array_filter([
            'room_id' => $this->room_id,
            'user_id' => $this->user_id,
            'message' => $this->message,
            'from_app' => $this->from_app,
            'read_at' => $this->read_at,
            'files' => $this->files,
        ], fn($value) => !is_null($value));
    }
}
