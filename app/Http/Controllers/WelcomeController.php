<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Services\CategoryService;
use App\Services\Jobs\JobService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WelcomeController extends Controller
{

    public function __construct(protected CategoryService $categoryService, protected JobService $jobService)
    {
    }
    public function __invoke()
    {

        $categories = Helper::getCategories();
        $categoriesWithTaskCount = $this->categoryService->categoriesWithTaskCount()->take(8);
        $jobs = $this->jobService->activeJobs()->take(10);
        $topCategoriesJobs = $this->jobService->topCategoriesJobs()->take(4);
        // dd($jobs);

        return Inertia::render('Welcome',
                [
                    'categories' => $categories,
                    'categoriesWithTaskCount' => $categoriesWithTaskCount,
                    'jobs' => $jobs
                ]);
    }

}
