<?php

namespace App\DTO\User;


class UserDTO
{
    public function __construct(
        public ?string $name,
        public ?string $email,
        public ?string $phone,
        public ?int $location_id,
        public ?string $avatar,
        public ?string $lang,
        public ?int $point

    ) {
    }

    public static function fromUserDTO($data): self
    {

        return new self(
            $data->name ?? null,
            $data->email ?? null,
            $data->phone ?? null,
            $data->location_id ?? null,
            $data->avatar ?? null,
            $data->lang ?? null,
            $data->point ?? null

        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'location_id' => $this->location_id,
            'avatar' => $this->avatar,
            'lang' => $this->lang,
            'point' => $this->point
        ];
    }
}
