<?php

namespace App\Http\Controllers\User\Jobs;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Services\Jobs\JobService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SingleJobeController extends Controller
{
    public function __construct(protected JobService $jobService)
    {
    }

    public function __invoke($locale, $id)
    {

        // $locations = Helper::getLocations();
        // $categories = Helper::getCategories();

        $job = $this->jobService->getJob($id);
        $related_jobs = $this->jobService->relatedJobsExcludingThisId($id, $job->sub_category_id);
        // dd($job);

        if (!$job) {
            return response()->json(['message' => 'Task not found or not active'], 404);
        }


        return Inertia::render('Jobs/SingleJob', ['job' => $job, 'related_jobs' => $related_jobs]);
    }
}
