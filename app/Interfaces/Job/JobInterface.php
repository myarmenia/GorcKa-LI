<?php

namespace App\Interfaces\Job;

interface JobInterface
{
    public function getActiveJobs($data = null);
}
