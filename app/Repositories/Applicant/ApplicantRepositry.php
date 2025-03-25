<?php

namespace App\Repositories\Applicant;

use App\Interfaces\Applicant\ApplicantInterface;
use App\Interfaces\Specialist\SpecialistInterface;
use App\Models\Applicant;
use App\Models\ExecutorInfo;
use App\Repositories\BaseRepository;

class ApplicantRepositry extends BaseRepository implements ApplicantInterface
{
    public function __construct(Applicant $model)
    {
        parent::__construct($model);
    }


}
