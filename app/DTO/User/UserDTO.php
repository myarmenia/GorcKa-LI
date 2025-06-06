<?php

namespace App\DTO\User;

use Illuminate\Http\UploadedFile;


class UserDTO
{
    public function __construct(
        public ?string $name,
        public ?string $email,
        public ?string $phone,
        public ?int $location_id,
        public UploadedFile|string|null $avatar = null,
        public ?string $lang,
        public ?int $point,
        public ?string $description,
        public ?SocialsDTO $socials = null,
        public ?bool $remove_avatar = null,
        public ?array $work_images = null


    ) {
    }

    public static function fromUserDTO($data): self
    {

        return new self(
            $data->name ?? null,
            $data->email ?? null,
            $data->phone ?? null,
            $data->location_id ?? null,
            $data->file('avatar') ?? null,
            $data->lang ?? null,
            $data->point ?? null,
            $data->description ?? null,
            SocialsDTO::fromArray($data->input('socials') ?? []),
            $data->remove_avatar ?? null,
            $data->work_images ?? null,


        );
    }

    public function toArray(): array
    {
        $data = [
            'name' => $this->name,
            'phone' => $this->phone,
            'location_id' => $this->location_id,
            'lang' => $this->lang,
            'description' => $this->description
        ];

        if ($this->remove_avatar) {
            $data['avatar'] = null;
        } elseif ($this->avatar) {
            $data['avatar'] = $this->avatar;
        }

        return $data;
    }
}
