<?php
namespace App\Repositories\Task;


use App\Interfaces\Task\TaskInterface;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskRepository implements TaskInterface
{
    public function store($taskTDO){

        $taskTDO['user_id'] = Auth::id();
        $data = Task::create($taskTDO);

        return $data;

    }
}
