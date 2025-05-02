<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $room_id;
    public $user_id;


    /**
     * Create a new event instance.
     */
    public function __construct($message)
    {
        $this->message = $message;
        $this->room_id = $message->room_id;
        $this->user_id = $message->user_id;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            // new PrivateChannel('room.' . $this->room_id)
            new PresenceChannel('presence-room.' . $this->room_id),
        ];
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'user' => $this->message->user,
            'id' => $this->user_id,  // Передаем id пользователя
            'room_id' => $this->room_id
            // 'name' => $this->user->name,
            // Другие данные пользователя
        ];
    }

    public function broadcastAs()
    {
        return 'MessageSent';
    }
}
