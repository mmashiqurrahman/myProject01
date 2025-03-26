<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class BroadcastEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $message;
    public string $user_name;
    protected string $channelname;
    /**
     * Create a new event instance.
     */
    public function __construct(string $message, string $user_name, string $channelname)
    {
        $this->message = $message;
        $this->user_name = $user_name;
        $this->channelname = $channelname;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        Log::info('Message being broadcast using queue: '.$this->message);
        return new PrivateChannel($this->channelname);
    }

    public function broadcastAs(): string
    {
        return 'chat';
    }
}