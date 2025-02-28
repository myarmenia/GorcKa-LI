<?php
namespace App\Repositories\Task;


use App\Interfaces\Task\TaskInterface;
use App\Models\Task;

class TaskRepository implements TaskInterface
{
    public function store($taskTDO){


        $data = Task::create($taskTDO);

        return $data;

    }
}
