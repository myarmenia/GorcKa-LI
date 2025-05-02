<?php
namespace App\Services\Chat;

use App\Events\OnlineUser;
use App\Interfaces\Chat\ChatInterface;
use App\Interfaces\Chat\RoomInterface;
use App\Models\Task;
use Auth;


class ChatService
{

    // public function __construct(protected ChatInterface $chatRepository)
    // {
    // }

    public function __construct(protected RoomInterface $roomRepository)
    {
    }

    public function getRoomsWithApplicants()
    {
        // dd($this->chatRepository->getRooms());
        // return $this->chatRepository->getRooms();
        event(new OnlineUser(Auth::id()));

        return $this->roomRepository->getRooms();


    }




}
