<?php
namespace App\Services;

use App\Interfaces\Task\TaskInterface;

 class TaskService {

    public function __construct(protected TaskInterface $taskRepository){

    }
     public function createTask($dto){
       

        $data=$this->taskRepository->store($dto);

     }

 }
