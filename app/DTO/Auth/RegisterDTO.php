<?php

namespace App\DTO\Auth;


class RegisterDTO
{
    public function __construct(
        public ?string $name,
        public ?string $email,
        public ?string $phone,
        public ?int $location_id,
        public ?string $password
    ) {}

    public static function fromRegisterDTO(array $data): self
    {
        return new self(
            $data['name'] ?? null,
            $data['email'] ?? null,
            $data['phone'] ?? null,
            $data['location_id'] ?? null,
            $data['password'] ?? null

        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'location_id' => $this->location_id,
            'password' => $this->password,

        ];
    }
}
