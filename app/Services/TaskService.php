<?php
namespace App\Services;

use App\Interfaces\Task\TaskInterface;
use App\Models\Filable;
use App\Models\Task;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

 class TaskService {

    public function __construct(protected TaskInterface $taskRepository){

    }
    public function list(){

        $data = $this->taskRepository->index();
        return $data;

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
            $path = FileUploadService::upload($fle,"task/".$task->id);
            // dd($path);
            $task->files()->create([
                'path' => $path,
                'name' => $fle->getClientOriginalName()
            ]);

        }
        return true;

     }

 }
