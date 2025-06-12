<?php

namespace App\DTO\User;

class SocialsDTO
{
    public function __construct(
        public ?string $facebook = null,
        public ?string $linkedin = null,
        public ?string $telegram = null,
        public ?string $whatsapp = null,
    ) {
    }

    public static function fromArray(?array $data): self
    {
        return new self(
            $data['facebook'] ?? null,
            $data['linkedin'] ?? null,
            $data['telegram'] ?? null,
            $data['whatsapp'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'facebook' => $this->facebook,
            'linkedin' => $this->linkedin,
            'telegram' => $this->telegram,
            'whatsapp' => $this->whatsapp,
        ];
    }
}
