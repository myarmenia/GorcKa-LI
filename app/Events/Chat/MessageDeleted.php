<?php

namespace App\Events\Chat;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageDeleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $roomId;

    public function __construct($message)
    {
        $this->message = $message;
        $this->roomId = $message->room_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */


    public function broadcastOn()
    {
        return [new PresenceChannel("presence-room.{$this->roomId}")];
    }

    public function broadcastWith(): array
    {
        return [
            'messageId' => $this->message->id,
            'date' => $this->message->created_at->format('Y-m-d'), // <-- ВАЖНО
        ];
    }

    public function broadcastAs()
    {
        return 'MessageDeleted';
    }
}
