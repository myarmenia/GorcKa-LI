<?php
namespace App\Services;

use App\Interfaces\Category\CategoryInterface;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\SubCategoryTranslation;


class CategoryService
{

    public function __construct(protected CategoryInterface $categoryRepository)
    {
    }
    public function categoriesWithTaskCount()
    {
        return $this->categoryRepository->allWithTaskCount();

    }


}
