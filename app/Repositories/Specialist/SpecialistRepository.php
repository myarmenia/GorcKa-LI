<?php

namespace App\Repositories\Specialist;

use App\Interfaces\Specialist\SpecialistInterface;
use App\Models\ExecutorInfo;
use App\Repositories\BaseRepository;

class SpecialistRepository extends BaseRepository implements SpecialistInterface
{
    public function __construct(ExecutorInfo $model)
    {
        parent::__construct($model);
    }

    public function getActiveSpecialist()
    {
        return $this->model->with('activeUser')->whereHas('activeUser')->get();
    }
}
