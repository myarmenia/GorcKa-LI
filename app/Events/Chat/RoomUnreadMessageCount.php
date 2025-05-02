<?php

namespace App\Events\Chat;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RoomUnreadMessageCount implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $count;
    protected $room_id;
    protected $user_id;

    /**
     * Create a new event instance.
     */
    public function __construct($count, $room_id, $user_id)
    {

        $this->count = $count;
        $this->room_id = $room_id;
        $this->user_id = $user_id;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel("room-unread-message-count.$this->room_id.$this->user_id"),
        ];
    }

    public function broadcastAs()
    {
        return 'RoomUnreadMessageCount';
    }
}
