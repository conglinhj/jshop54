<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\DbCart;
use Gloudemans\Shoppingcart\Facades\Cart;

class UserLogged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $db_cart;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(DbCart $dbCart, Cart $cart)
    {
        $this->db_cart = $dbCart;
        $this->ss_cart = $cart;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
