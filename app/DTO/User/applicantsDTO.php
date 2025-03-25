<?php

namespace App\DTO\User;


class ApplicantsDTO
{
    public function __construct(
        public int $task_id,
        public ?int $point,
        public ?int $user_id

    ) {
    }

    public static function fromApplicantDTO( $data): self
    {

        return new self(
            $data->id ?? null,
            $data->point ?? null,
            $data->user_id ?? null

        );
    }

    public function toArray(): array
    {
        return [
            'task_id' => $this->task_id,
            'point' => $this->point,
            'user_id' => $this->user_id
        ];
    }
}
