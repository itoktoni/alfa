<?php

namespace Modules\Item\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GantiChipLinenEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $rfid;
    public $old_rfid;
    public $company_id;
    public $location_id;
    public $product_id;
    public $rent;
    public $status;

    /**
     * Create a old_rfid event instance.
     *
     * @return void
     */
    public function __construct($rfid, $old_rfid, $company_id, $location_id, $product_id, $rent, $status)
    {
        $this->rfid = $rfid;
        $this->old_rfid = $old_rfid;
        $this->company_id = $company_id;
        $this->location_id = $location_id;
        $this->product_id = $product_id;
        $this->rent = $rent;
        $this->status = $status;
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
