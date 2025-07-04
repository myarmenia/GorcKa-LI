<?php

namespace App\Interfaces\Specialist;
use App\Models\User;

interface SpecialistDetailsInterface

{
    public function getById($specialist): User;
}
