<?php

namespace App\DTO\Contact;


class ContactDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public ?string $subject,
        public string $your_message,


    ) {
    }

    public static function fromRequestDTO($data): self
    {

        return new self(
            $data->name,
            $data->email,
            $data->subject ?? null,
            $data->your_message,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'your_message' => $this->your_message,

        ];
    }
}
