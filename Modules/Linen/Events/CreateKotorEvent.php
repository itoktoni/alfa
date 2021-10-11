<?php

namespace Modules\Linen\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Linen\Dao\Facades\KotorFacades;

class CreateKotorEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;
    public $model;
    public $rfid;
    public $linen;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
        $this->model = KotorFacades::with('has_detail')->find($id) ?? false;
        $this->linen = $this->model->has_detail ?? false;
        $this->rfid = $this->linen->pluck('linen_kotor_detail_rfid')->unique() ?? false;
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
