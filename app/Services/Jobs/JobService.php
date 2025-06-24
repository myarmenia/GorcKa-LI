<?php
namespace App\Services\Jobs;

use App\Interfaces\Job\JobInterface;
use App\Models\SubCategory;
use App\Models\Task;


class JobService
{

    public function __construct(protected JobInterface $jobRepository, protected Task $task)
    {
    }

    public function getJob($id){
        return $this->jobRepository->getActiveJob($id);

    }

    public function activeJobs(){
        return $this->jobRepository->getActiveJobs();
    }

    public function relatedJobsExcludingThisId($id, $sub_category_id){

        $data = $this->jobRepository->relatedJobsExcludingThisId($id, $sub_category_id);

        return $data;
    }

    public function topCategoriesJobs(){
        $data = $this->jobRepository->topCategoriesJobs();

        return $data;
    }

    public function filterJobs($data)
    {

        $data['sub_category_id'] = !empty($data['sub_category_id']) ? $data['sub_category_id'] : null;

        if (!empty($data['category_id'])) {
            $data['sub_category_id'] = SubCategory::where('category_id', $data['category_id'])
                ->pluck('id')
                ->toArray();

        }


        if (!empty($data['category_ids'])) {
            $additionalSubCategories = SubCategory::whereIn('category_id', $data['category_ids'])
                ->pluck('id')
                ->toArray();

            $data['sub_category_id'] = array_unique(array_merge($data['sub_category_id'] ?? [], $additionalSubCategories));
        }

        $data['title'] = $data['name'] ?? null;
        $data['description'] = $data['name'] ?? null;


        $data = array_filter($data, function ($value) {
            return $value !== null && $value !== 'null';
        });


        $filter = $this->task->filter($data);
        

        $result = $this->jobRepository->getActiveJobs($filter);

        return $result;

    }


}
