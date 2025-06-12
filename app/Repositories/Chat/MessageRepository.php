<?php

namespace App\Repositories\Chat;

use App\Interfaces\Chat\MessageInterface;
use App\Models\Message;
use App\Models\Room;
use App\Models\Task;
use App\Repositories\BaseRepository;
use Auth;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class MessageRepository extends BaseRepository implements MessageInterface
{
    // protected Model $model;

    // public function __construct(Message $model)
    // {
    //     $this->model = $model;
    // }

    public function __construct(Message $model)
    {
        parent::__construct($model);
    }

    public function getRoomMessages(int $roomId):Collection
    {
        return  $this->model->with('files:filable_id,name,ext,path as file_path')->where('room_id', $roomId)
            ->orderBy('created_at')
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y-m-d');
            })
            ->map(function ($groupedByDate) {
                return $groupedByDate->groupBy(function ($item) {
                    return $item->from_app === 1 ? 'from_app' : 'other';
                });
            });

    }

    public function getUnreadMessages(int $roomId, int $userId)
    {
        return $this->model
            ->where('room_id', $roomId)
            ->where('user_id', $userId)
            ->whereNull('read_at');
    }

    public function getUnreadMessagesCount(int $roomId, int $userId): int
    {
        return $this->getUnreadMessages($roomId, $userId)->count();

    }

    public function getAllUnreadMessagesCount( int $userId): int
    {
        return $this->model
            ->where('user_id', $userId)
            ->whereNull('read_at')->count();

    }

    public function readMessages(int $roomId, int $userId){
        $this->getUnreadMessages($roomId, $userId)->update(['read_at' => now()]);
    }




}
