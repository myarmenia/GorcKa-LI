<?php
namespace App\Services\Chat;

use App\Events\OnlineUser;
use App\Interfaces\Chat\RoomInterface;
use App\Interfaces\Job\JobInterface;
use Auth;


class ChatService
{

    // public function __construct(protected ChatInterface $chatRepository)
    // {
    // }

    public function __construct(
        protected RoomInterface $roomRepository,
        protected JobInterface $jobInterface
        )
    {
    }

    public function getRoomsWithApplicants($reques)
    {
        // dd($this->chatRepository->getRooms());
        // return $this->chatRepository->getRooms();
        event(new OnlineUser(Auth::id()));

        return $this->roomRepository->getRooms($reques);


    }

    public function deleteRoom($id)
    {

        $deleted = $this->roomRepository->delete($id);

        return $deleted;

    }



}
