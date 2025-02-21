<?php

namespace App\DTO;
use Illuminate\Http\Request;
class TaskDTO
{
    public function __construct(
        public string $title,
        public int $sub_category_id,
        public int $location_id,
        public string $price_min,
        public string $price_max,
        public string $start_date,
        public string $end_date,
        public string $executor_id,
        public string $status,

    )
    {}
    public function from


}
