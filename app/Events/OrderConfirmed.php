<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class OrderConfirmed
{
    use SerializesModels;

    /**
     * The order.
     *
     * @var \App\Order
     */
    public $order;

    /**
     * Create a new event instance.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function __construct($order)
    {
		$this->order = $order;
    }
}