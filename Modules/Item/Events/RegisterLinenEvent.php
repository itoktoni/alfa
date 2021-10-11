<?php

namespace Modules\Item\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RegisterLinenEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $rfid;
    public $company_id;
    public $location_id;
    public $product_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($rfid, $company_id, $location_id, $product_id)
    {
        $this->rfid = $rfid;
        $this->company_id = $company_id;
        $this->location_id = $location_id;
        $this->product_id = $product_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
