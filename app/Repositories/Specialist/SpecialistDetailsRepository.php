<?php

namespace App\Repositories\Specialist;

use App\Interfaces\Specialist\SpecialistDetailsInterface;
use App\Interfaces\Specialist\SpecialistInterface;
use App\Models\ExecutorInfo;
use App\Repositories\BaseRepository;

class SpecialistDetailsRepository implements SpecialistDetailsInterface
{
    public function getById($specialist)
    {

      return $specialist->load('social_medias','executor_sub_categories');

    }
}
