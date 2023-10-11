<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\Factory;

class UpdatingFactory
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $newFactory;
    public $oldFactory;
    /**
     * Create a new event instance.
     */
    public function __construct(Factory $newFactory, Factory $oldFactory)
    {
        $this->newFactory = $newFactory;
        $this->oldFactory = $oldFactory;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
