<?php

namespace App\Http\Controllers;

use App\Services\FilterService;

class CategoryWithSubCategoryFilterController extends Controller
{
    public function __invoke($model, $value)
    {

        $result = FilterService::filter($model, $value, 'scopeCategoryWithSubCategoryFilter');

        return response()->json($result);
    }
}
