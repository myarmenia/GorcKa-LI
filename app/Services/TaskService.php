<?php
namespace App\Services;

use App\Interfaces\Task\TaskInterface;
use App\Models\Filable;
use App\Models\SubCategory;
use App\Models\Task;
use App\Traits\FilterTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

 class TaskService {

        use FilterTrait;

    public function __construct( protected Task $model,protected TaskInterface $taskRepository){

    }
    public function list($data){

        if(!empty($data['category_id'])){
          $data['sub_category_id'] = !empty($data['sub_category_id']) ? $data['sub_category_id'] : null;

        }

        if (!empty($data['category_id'])) {
            $data['sub_category_id'] = SubCategory::where('category_id', $data['category_id'])
                ->pluck('id')
                ->toArray();

        }
         $data['title'] = $data['name'] ?? null;
         $data['description'] = $data['name'] ?? null;
        //  dd($data);
        $query = $this->model->where('user_id', auth()->id())
                 ->with('files', 'location.translation','sub_category','sub_category.category')
                 ->filter($data)->orderBy('id', 'desc');
                //  dd($query->get());

        return  $query;


    }
    public function createTask($dto){

        $files_arr = $dto->file;

        $taskTDO = Arr::except($dto->toArray(), ['file']);
        $task = $this->taskRepository->store($taskTDO);


        if($files_arr != null){

            $files = $this->file_upload($files_arr,  $task);
        }
        return true;



    }
    public function edit ($id){

        return $this->taskRepository->edit($id);
    }
    public function updateTask($dto,$id){
// dd($dto);
        $files_arr = $dto->file;
        $taskTDO = Arr::except($dto->toArray(), ['file']);

        $task = $this->taskRepository->update($taskTDO, $id);

        if($files_arr != null){

            $files = $this->file_upload($files_arr,  $task);
        }


    }

     public function file_upload( $files_arr, $task ){

        foreach( $files_arr as $fle){

            $extension = $fle->getClientOriginalExtension();
            $path = FileUploadService::upload($fle,"task/".$task->id);

            $task->files()->create([
                'name' => $fle->getClientOriginalName(),
                'path' => $path,
                'ext'  =>  $extension

            ]);

        }
        return true;

     }

 }
