<?php
namespace App\Repositories\Task;


use App\Http\Resources\TaskListResource;
use App\Interfaces\Task\TaskInterface;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskRepository implements TaskInterface
{
    public function index(){

        $data = auth()->user()->tasks()->with('files')->get();
        // dd($data->toArray());

        return $data;

    }
    public function store($taskTDO){

        $taskTDO['user_id'] = Auth::id();
        $data = Task::create($taskTDO);

        return $data;

    }
    public function edit($id){

        return Task::find($id);
    }
}
