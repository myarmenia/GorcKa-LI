<?php
namespace App\Services\Specialist;

use App\Interfaces\Specialist\SpecialistDetailsInterface;

use App\Models\Category;
use App\Models\ExecutorInfo;
use App\Models\ExecutorSlSubCategory;
use App\Models\SubCategory;

use Storage;




class SpecialistDetailsService
{

    public function __construct(protected SpecialistDetailsInterface $specialistDetailsRepository){}

    public function getSpecialist($specialist)
    {
        return $this->specialistDetailsRepository->getById($specialist);
    }

}
