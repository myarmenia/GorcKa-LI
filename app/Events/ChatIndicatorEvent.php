<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatIndicatorEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    public $count;
    // public $type;
    public $user_id;

    public function __construct(int $count,
    // string $type,
    $user_id)
    {

        $this->count = $count;
        // $this->type = $type;
        $this->user_id = $user_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {


        // return  new Channel('notification-count' );
        return [
            new PrivateChannel('unread-message-count.' . $this->user_id)
            // new PrivateChannel('notification-count' )
        ];
    }


    public function broadcastAs()
    {
        return 'ChatIndicatorEvent';
    }
}
