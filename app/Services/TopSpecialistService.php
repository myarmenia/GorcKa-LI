<?php
namespace App\Services;

use App\Interfaces\Category\CategoryInterface;
use App\Interfaces\Specialist\TopSpecialistInterface;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\SubCategoryTranslation;


class TopSpecialistService
{

    public function __construct(protected TopSpecialistInterface $topSpecialistRepository)
    {
    }
    public function getTopSpecialistRating()
    {
        return $this->topSpecialistRepository->getTopSpecialistRating();

    }


}
