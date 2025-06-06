<?php

namespace App\Repositories\Chat;

use App\Interfaces\Chat\RoomInterface;
use App\Models\Room;
use App\Models\Task;
use App\Repositories\BaseRepository;
use Auth;
use Illuminate\Support\Facades\Request;

class RoomRepositry extends BaseRepository implements RoomInterface
{
    public function __construct(Room $model, protected MessageRepository $messageRepository)
    {
        parent::__construct($model);
    }

    public function getInterlocutorId($roomId): ?int
    {
        $room = $this->getById($roomId);
        $currentUserId = auth()->id();

        if (!$room) {
            return null;
        }

        if ($room->employer_id === $currentUserId) {
            return $room->executor_id;
        }

        if ($room->executor_id === $currentUserId) {
            return $room->employer_id;
        }

        return null;
    }

    // public function getRooms()
    // {

    //     $user = Auth::user();

    //     $rooms = $user->rooms()->with(['executor:id,name,avatar'])->get();
    //     // $rooms = $user->rooms()->get();


    //     $taskTitles = Task::whereIn('id', $rooms->pluck('task_id')->unique())
    //         ->pluck('title', 'id');

    //     // Группируем комнаты по task_id и переименовываем ключи в title
    //     $grouped = $rooms->groupBy('task_id')->mapWithKeys(function ($group, $taskId) use ($taskTitles) {
    //         $title = $taskTitles[$taskId] ?? 'Без названия';
    //         return [$title => $group];
    //     });

    //     return $grouped;

    // }

    // public function getRooms($request)
    // {
    //     $user = Auth::user();
    //     $currentUserId = $user->id;
    //     $search = $request->input('search');

    //     $rooms = $user->roomsAll()
    //         ->with(['executor:id,name,avatar', 'employer:id,name,avatar', 'task:id,status,executor_id'])
    //         ->get();

    //     // Добавляем поле interlocutor
    //     $rooms->each(function ($room) use ($currentUserId) {
    //         $room->interlocutor = $room->employer_id === $currentUserId
    //             ? $room->executor
    //             : $room->employer;
    //         $room->unread_count = $this->messageRepository->getUnreadMessagesCount($room->id, $currentUserId);
    //     });

    //     $taskTitles = Task::whereIn('id', $rooms->pluck('task_id')->unique())
    //         ->pluck('title', 'id');

    //     $grouped = $rooms->groupBy('task_id')->mapWithKeys(function ($group, $taskId) use ($taskTitles) {
    //         $title = $taskTitles[$taskId] ?? 'Без названия';
    //         return [$title => $group];
    //     });

    //     return $grouped;
    // }

    public function getRooms($request)
    {
        $user = Auth::user();
        $currentUserId = $user->id;
        $search = $request->input('search');

        $query = $user->roomsAll()
            ->with([
                'executor:id,name,avatar',
                'employer:id,name,avatar',
                'task:id,title,status,executor_id',
                'messages:id,room_id,message'
            ]);

        // Если есть поисковый запрос
        if ($search) {

            $query->where(function ($q) use ($search) {
                // Поиск по названию задания
                $q->whereHas('task', function ($q2) use ($search) {
                    $q2->where('title', 'like', '%' . $search . '%');
                })
                    // Или по тексту сообщений
                    ->orWhereHas('messages', function ($q3) use ($search) {
                        $q3->where('message', 'like', '%' . $search . '%');
                    });
            });
        }

        $rooms = $query->get();

        // Добавляем interlocutor и unread_count
        $rooms->each(function ($room) use ($currentUserId) {
            $room->interlocutor = $room->employer_id === $currentUserId
                ? $room->executor
                : $room->employer;

            $room->unread_count = $this->messageRepository->getUnreadMessagesCount($room->id, $currentUserId);
        });

        // Группировка по названию задачи
        $taskTitles = Task::whereIn('id', $rooms->pluck('task_id')->unique())
            ->pluck('title', 'id');

        $grouped = $rooms->groupBy('task_id')->mapWithKeys(function ($group, $taskId) use ($taskTitles) {
            $title = $taskTitles[$taskId] ?? 'Без названия';
            return [$title => $group];
        });

        return $grouped;
    }

}
