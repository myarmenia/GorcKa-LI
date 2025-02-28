<?php

namespace App\Http\Controllers;

use App\Services\CategoryWithSubCategoryFilterService;

class CategoryWithSubCategoryFilterController extends Controller
{
    public function __invoke($value)
    {

        $result = CategoryWithSubCategoryFilterService::filter($value);

        return response()->json($result);
    }
}
