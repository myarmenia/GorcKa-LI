<?php
namespace App\Services\User\Notify;

use App\DTO\Chat\RoomDTO;
use App\Interfaces\Chat\RoomInterface;
use App\Models\Room;
use Illuminate\Database\Eloquent\Collection;

class RoomCreatorService{

    public function __construct(
        protected RoomInterface $roomRepository
    ) {
    }

    public function create(object $data, object $user, object $employer): Room
    {
        $roomData = new RoomDTO(
            employer_id: $employer->id,
            executor_id: $user->id,
            task_id: $data->id
        );

        $room = $this->roomRepository->store($roomData->toArray());

        return $room;
    }


}
