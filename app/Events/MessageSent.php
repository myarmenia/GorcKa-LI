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
            'message' => [
                'id' => $this->message->id,
                'message' => $this->message->message,
                'created_at' => $this->message->created_at,
                'files' => $this->message->files->map(function ($file) {
                    return [
                        'filable_id' => $file->filable_id,
                        'name' => $file->name,
                        'file_path' => asset('storage/'. $file->path),
                        'ext' => $file->ext
                    ];
                }),
                'user_id' => $this->user_id,
                'room_id' => $this->room_id,
            ],

        ];
    }

    public function broadcastAs()
    {
        return 'MessageSent';
    }
}
