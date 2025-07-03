<?php

namespace App\DTO\Comment;


class CommentDTO
{
    public function __construct(
        public int $task_id,
        public int $notification_id,
        public ?int $author_id,
        public ?int $recipient_id,
        public ?string $description,
        public ?int $mark,
        public ?string $role_from,
        public ?string $role_to

    ) {
    }

    public static function fromCommentDTO($data): self
    {

        return new self(
            $data->task_id,
            $data->notification_id,
            $data->author_id ?? null,
            $data->recipient_id ?? null,
            $data->description ?? null,
            $data->mark ?? null,
            $data->role_from ?? null,
            $data->role_to ?? null

        );
    }

    public function toArray(): array
    {
        return [
            'task_id' => $this->task_id,
            'author_id' => $this->author_id,
            'recipient_id' => $this->recipient_id,
            'description' => $this->description,
            'mark' => $this->mark,
            'role_from' => $this->role_from,
            'role_to' => $this->role_to

        ];
    }
}
