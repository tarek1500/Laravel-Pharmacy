<?php

namespace App\Listeners;

use App\Events\OrderConfirmed;
use App\Notifications\SendOrderStatusMessage;

class SendOrderStatusEmailNotification
{
    /**
     * Handle the event.
     *
     * @param  OrderConfirmed  $event
     * @return void
     */
    public function handle(OrderConfirmed $event)
    {
		$order = $event->order;
		$order->user->notify(new SendOrderStatusMessage($order));
    }
}