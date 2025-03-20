<?php

namespace App\Repositories\Job;

use DB;
use Carbon\Carbon;
use App\Models\Task;
use App\Interfaces\Job\JobInterface;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class JobRepository extends BaseRepository implements JobInterface
{

    // public function __construct(Task $model)
    // {
    //     parent::__construct($model);
    // }

    protected Model $model;

    public function __construct(Task $model)
    {
        $this->model = $model;
    }

    public function getActiveJob($id)
    {
        $task = $this->model->with([
            'user:id,name,email,phone',
            'sub_category.category:id,icon',
            'location.translation:location_id,name', // Загрузим только нужные поля из translation
        ])->findOrFail($id);


        if ($task && $task->status == 'active') {
            return $task;
        }

        return null;
    }


    public function getActiveJobs($data = null)
    {
        // $data = $data->with([
        //     'sub_category.category:id,color',  // Загрузим только id и color из связанной таблицы category
        //     'location.translation:location_id,name', // Загрузим только нужные поля из translation
        // ])->get();
        // dd($data[0]->location_translation_name);


        // $data = null when get for homepage
        $data = $data ?? $this->model;
        $data = $data->where('tasks.status', 'active')->orderBy('id', 'desc');
        $data = $this->getSelectedData($data);

        // dd($data);

        return $data;

    }

    public function relatedJobsExcludingThisId($id, $sub_category_id){

        $data = $this->model->where('sub_category_id', $sub_category_id)->where('tasks.id', '!=', $id);
        $data = $this->getSelectedData($data);

        return $data;
    }


    private function getSelectedData($data){

        $result = $data
            ->leftJoin('sub_categories', 'tasks.sub_category_id', '=', 'sub_categories.id')
            ->leftJoin('categories', 'sub_categories.category_id', '=', 'categories.id')
            ->leftJoin('locations', 'tasks.location_id', '=', 'locations.id')
            ->leftJoin('location_translations', function ($join) {
                $join->on('locations.id', '=', 'location_translations.location_id')
                    ->where('location_translations.lang', app()->getLocale())
                    ->whereRaw(
                        'location_translations.id = (SELECT MIN(id) FROM location_translations WHERE location_id = locations.id AND lang = ?)',
                        [app()->getLocale()]
                    );
            })
            ->select([
                'tasks.id',
                'tasks.title',
                'tasks.status',
                'tasks.task_type',
                'tasks.description',
                'tasks.price_min',
                'tasks.price_max',
                'tasks.start_date',
                'tasks.end_date',
                'sub_categories.category_id',
                'categories.icon as category_icon',
                'categories.color as category_color',
                'location_translations.name as translation_name'
            ])
            ->get()
            ->map(function ($task) {
                $task->start_date = $task->start_date ? Carbon::parse($task->start_date)->format('d-m-Y') : null;
                $task->end_date = $task->end_date ? Carbon::parse($task->end_date)->format('d-m-Y') : null;
                return $task;
            });


        return $result;

    }
}
