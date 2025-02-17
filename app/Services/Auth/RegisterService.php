<?php

namespace App\Services\Auth;

use App\DTO\RegisterDTO;
use App\Interfaces\Auth\RegisterInterface;
use App\Models\Location;

class RegisterService
{
    public function __construct(protected RegisterInterface $registerRepository) {}


    public function create()
    {
        $locations = Location::with([
            'translations' => function ($query) {
                $query->where('lang_id', 1);
            }
        ])->get();

        return $locations;
    }


    public function store(RegisterDTO $dto)
    {
        return $this->registerRepository->store($dto->toArray());
    }


}
