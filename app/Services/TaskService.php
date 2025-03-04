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
    public function createTask($dto){

        $files_arr = $dto->file;
        $taskTDO = Arr::except($dto->toArray(), ['file']);
        $task = $this->taskRepository->store($taskTDO);

        if($files_arr!=null){
            foreach( $files_arr as $fle){
                $path = FileUploadService::upload($fle,"task/".$task->id);
                $task->files()->create([
                    'file_path' => $path,
                    'file_name' => $fle->getClientOriginalName()
                ]);
            }

        }



    }

     public function file_upload(){

     }

 }
