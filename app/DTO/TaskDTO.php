<?php

namespace App\DTO;
use Illuminate\Http\Request;
use Carbon\Carbon;
class TaskDTO
{
    public function __construct(
        public string $title,
        public int $sub_category_id,
        public int $location_id,
        public int $price_min,
        public int $price_max,
        public Carbon $start_date,
        public Carbon $end_date,
        public ?int $executor_id,
        public ?string $status,
        public ?string $file,

    )
    {}
    public static function fromArray(array $data): self
    {

        return new self(
            $data['title'],
            $data['sub_category_id'] ?? null,
            $data['location_id'],
            $data['price_min'],
            $data['price_max'],
            Carbon::parse($data['start_date']), // Преобразуем дату в Carbon
            Carbon::parse($data['end_date']),
            isset($data['executor_id']) ? (int) $data['executor_id'] : null,
            $data['status'] ?? null,
            isset($data['file']) ? $data['file'] : null
        );
    }

}
