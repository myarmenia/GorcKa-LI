<?php
namespace App\Repositories\Task;


use App\Interfaces\Task\TaskInterface;


class TaskRepository implements TaskInterface
{
    public function store($taskTDO){
        dd($taskTDO);
        // $data = Task::create();

        // return $data;

    }
}
