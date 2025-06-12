<?php

namespace App\Observers;

use App\Events\Chat\RoomUnreadMessageCount;
use App\Events\ChatIndicatorEvent;
use App\Models\Message;
use App\Repositories\Chat\MessageRepository;

class MessageObserver
{
    /**
     * Handle the Message "created" event.
     */
    public function created(Message $message): void
    {
        $room_id = $message->room_id;
        $user_id = $message->user_id;  // message for user

        if ($user_id) {
            $count = (new MessageRepository($message))->getUnreadMessagesCount($room_id, $user_id);
            $allUnreadMessageCount = (new MessageRepository($message))->getAllUnreadMessagesCount( $user_id);

            event(new RoomUnreadMessageCount($count, $room_id, $user_id));
            event(new ChatIndicatorEvent($allUnreadMessageCount,  $user_id));


        }
    }


    /**
     * Handle the Message "updated" event.
     */
    public function updated(Message $message): void
    {
        dd(55);
        $user_id = $message->user_id;  // message for user

        if ($user_id) {
            $allUnreadMessageCount = (new MessageRepository($message))->getAllUnreadMessagesCount( $user_id);

            event(new ChatIndicatorEvent($allUnreadMessageCount,  $user_id));


        }
    }



    /**
     * Handle the Message "deleted" event.
     */
    public function deleted(Message $message): void
    {
        //
    }



    /**
     * Handle the Message "restored" event.
     */
    public function restored(Message $message): void
    {
        //
    }

    /**
     * Handle the Message "force deleted" event.
     */
    public function forceDeleted(Message $message): void
    {
        //
    }
}
