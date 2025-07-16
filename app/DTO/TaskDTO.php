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
        public ?Carbon $start_date,
        public ?Carbon $end_date,
        public ?int $executor_id,
        public ?string $status,
        public ?string $description,
        public ?int $task_type,
        public ?array $file,

    )
    {}

    public static  function fromRequestDto(Request $request): TaskDTO {
        return  new self(
            title: $request->title,
            sub_category_id: (int) $request->sub_category_id,
            location_id: (int) $request->location_id,
            price_min: (int) $request->price_min,
            price_max: (int) $request->price_max,
            start_date: $request->start_date ? Carbon::parse($request->start_date) : null,
            end_date: $request->end_date ? Carbon::parse($request->end_date) : null,
            executor_id: $request->executor_id ? (int) $request->executor_id : null,
            status: $request->status ?? 'active',
            description: $request->description,
            task_type: $request->task_type ?? 0,
            file: $request->hasFile('file') ? $request->file('file') : null
        );

    }

    public function toArray()
    {
        return [
            'title' => $this->title,
            "sub_category_id" => $this->sub_category_id,
            "location_id" => $this->location_id,
            "price_min" => $this->price_min,
            "price_max" => $this->price_max,
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "executor_id" => $this->executor_id,
            "status" => $this->status,
            "description"=> $this->description,
            "task_type" => $this->task_type,
            "file" => $this->file



        ];
    }

}
