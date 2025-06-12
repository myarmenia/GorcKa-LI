<?php

namespace App\Repositories\Chat;

use App\Interfaces\Chat\ChatInterface;
use App\Models\Room;
use App\Models\Task;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ChatRepository implements ChatInterface
{
    protected Model $model;

    public function __construct(Room $model)
    {
        $this->model = $model;
    }

    public function getRooms()
    {

        $user = Auth::user();

        $rooms = $user->rooms()->with(['executor:id,name,avatar'])->get();
        // $rooms = $user->rooms()->get();


        $taskTitles = Task::whereIn('id', $rooms->pluck('task_id')->unique())
            ->pluck('title', 'id');

        // Группируем комнаты по task_id и переименовываем ключи в title
        $grouped = $rooms->groupBy('task_id')->mapWithKeys(function ($group, $taskId) use ($taskTitles) {
            $title = $taskTitles[$taskId] ?? 'Без названия';
            return [$title => $group];
        });

        return  $grouped;

    }



}
