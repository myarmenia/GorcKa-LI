<?php

namespace App\Http\Controllers\User\Categories;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoriesController extends Controller
{
    public function __construct(protected CategoryService $categoryService)
    {
    }
    public function __invoke(){

        $categoriesWithTaskCount = $this->categoryService->categoriesWithTaskCount();

        return Inertia::render('Categories/Index', ['categories' => $categoriesWithTaskCount]);
    }
}
