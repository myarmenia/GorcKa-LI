<?php

namespace App\Http\Controllers\User\Jobs;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Services\Jobs\JobService;
use App\Traits\Paginator;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobsController extends Controller
{
    use Paginator;

    public function __construct(protected JobService $jobService)
    {
    }
    public function __invoke(Request $request)
    {
        $perPage = 3;

        $locations = Helper::getLocations();
        $categories = Helper::getCategories();

        $jobs = $this->jobService->filterJobs($request->all());
        $jobs = $this->arrayPaginator($jobs, $request, $perPage);

        return Inertia::render('Jobs/Index', ['locations' => $locations, 'categories' => $categories, 'jobs' => $jobs]);
    }
}
