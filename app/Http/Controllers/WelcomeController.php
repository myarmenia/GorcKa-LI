<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Services\CategoryService;
use App\Services\Jobs\JobService;
use App\Services\TopSpecialistService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WelcomeController extends Controller
{

    public function __construct(
        protected CategoryService $categoryService,
        protected JobService $jobService,
        protected TopSpecialistService $topSpecialistService
        )
    {
    }
    public function __invoke()
    {

        $categories = Helper::getCategories();
        $categoriesWithTaskCount = $this->categoryService->categoriesWithTaskCount()->take(8);
        $jobs = $this->jobService->activeJobs()->take(10);
        $topCategoriesJobs = $this->jobService->topCategoriesJobs();
        $topSpecialistRating = $this->topSpecialistService->getTopSpecialistRating();
        // dd($topSpecialistRating);


        return Inertia::render('Welcome',
                [
                    'categories' => $categories,
                    'categoriesWithTaskCount' => $categoriesWithTaskCount,
                    'jobs' => $jobs,
                    'topCategoriesJobs' => $topCategoriesJobs,
                    'topSpecialistRating' => $topSpecialistRating,
                ]);
    }

}
