<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WelcomeController extends Controller
{

    public function __construct(protected CategoryService $categoryService)
    {
    }
    public function __invoke()
    {

        $categories = Helper::getCategories();
        $categoriesWithTaskCount = $this->categoryService->categoriesWithTaskCount()->take(8);

        return Inertia::render('Welcome', ['categories' => $categories, 'categoriesWithTaskCount' => $categoriesWithTaskCount]);
    }

}
