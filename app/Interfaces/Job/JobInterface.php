<?php

namespace App\Interfaces\Job;

use App\Interfaces\BaseInterface;

interface JobInterface extends BaseInterface
{
    public function getActiveJob($id);
    public function getActiveJobs($data = null);
    public function topCategoriesJobs();
    public function getUnselectedApplicants($job, $selected_user_id);
    public function relatedJobsExcludingThisId($id, $sub_category_id);
}
