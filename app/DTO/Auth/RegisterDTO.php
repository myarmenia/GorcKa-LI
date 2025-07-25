<?php

namespace App\DTO\Auth;


class RegisterDTO
{
    public function __construct(
        public ?string $name,
        public ?string $email,
        public ?string $phone,
        public ?int $location_id,
        public ?string $password,
        public ?string $referral_code,
        public ?string $referred_by_code_id

    ) {}

    public static function fromRegisterDTO(array $data): self
    {
        return new self(
            $data['name'] ?? null,
            $data['email'] ?? null,
            $data['phone'] ?? null,
            $data['location_id'] ?? null,
            $data['password'] ?? null,
            $data['referral_code'] ?? null,
            $data['referred_by_code_id'] ?? null

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
            'referred_by_code_id' => $this->referral_code

        ];
    }
}
